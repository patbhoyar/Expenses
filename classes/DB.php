<?php

class DB {

    private static $instance = NULL;
    private static $pdo;
    private static $config = array(
        'host'      =>  'localhost',
        'dbname'    =>  'Expenses',
        'username'  =>  'root',
        'password'  =>  'root'
    );
    private static $colors = array(
        "#B0BF1A", "#7CB9E8", "#B284BE", "#AF002A", "#08E8DE", "#E52B50", "#6D9BC3", "#CD9575", "#8F9779", "#FDEE00", "#FF91AF", "#A1CAF1", "#3D0C02"
    );
            
    
    function __construct() {
        try {
            self::$pdo = new PDO("mysql:host=" . self::$config['host'] . ";dbname=" . self::$config['dbname'], self::$config['username'], self::$config['password']);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new DB();
        }
        return self::$instance;
    }
    
    //====================================== EXPENSEITEM ======================================
    
    public static function createNewExpense($category, $itemName, $date, $paymentMode, $bankName, $amount, $checkNumber){
        self::$instance = self::getInstance();
        
        $query = self::$pdo->prepare("INSERT INTO `expense` (`category`, `itemName`, `date`, `paymentMode`, `bankName`, `amount`, `checkNumber`) VALUES (:category, :itemName, :date, :paymentMode, :bankName, :amount, :checkNumber)");
        $query->execute(array(':category' => $category, ':itemName' => $itemName, ':date' => $date, ':paymentMode' => $paymentMode, ':bankName' => $bankName, ':amount' => $amount, ':checkNumber' => $checkNumber));
        return self::$pdo->lastInsertId();
    }
    
    public static function getAllExpenses(){
        self::$instance = self::getInstance();
        $query = self::$pdo->prepare("CALL `getAllExpenses`();");
        $query->execute();
        $expenseItems = array();
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $expenseItem = new ExpenseItem($row['category'], $row['itemName'], $row['date'], $row['paymentMode'], $row['bankName'], $row['amount'], $row['checkNumber'], $row['categoryId'], $row['expId']);
            array_push($expenseItems, $expenseItem);
        }
        
        return $expenseItems;
    }
    
    public static function getExpenseById($id){
        self::$instance = self::getInstance();
        $query = self::$pdo->prepare("SELECT `category`, `itemName`, `date`, `paymentMode`, `bankName`, `amount`, `checkNumber` FROM `expense` WHERE id = :id");
        $query->execute(array(':id' => $id));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        
        $expense = new ExpenseItem($data['category'], $data['itemName'], $data['date'], $data['paymentMode'], $data['bankName'], $data['amount'], $data['checkNumber'], NULL, $id);
        return $expense;
    }
    
    public static function getExpensesByCategory($categoryId){
        self::$instance = self::getInstance();
        $query = self::$pdo->prepare("CALL getExpensesByCategory(:categoryId)");
        $query->execute(array(':categoryId' => $categoryId));
       
        $expenseItems = array();
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $expenseItem = new ExpenseItem($row['category'], $row['itemName'], $row['date'], $row['paymentMode'], $row['bankName'], $row['amount'], $row['checkNumber'], $row['categoryId'], $row['expId']);
            array_push($expenseItems, $expenseItem);
        }
        
        return $expenseItems;
    }
    
    public static function getBreakUpByCategory(){
        self::$instance = self::getInstance();
        $query = self::$pdo->prepare("CALL getBreakupByCategory()");
        $query->execute();
        $breakUps = array();
        $colorCounter = 0;
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $breakUpItem = array(
                'categoryId'    =>  $row['categoryId'],
                'categoryName'  =>  $row['categoryName'],
                'categoryTotal' =>  $row['total'],
                'categoryColor' =>  self::$colors[$colorCounter++]
            );
            array_push($breakUps, $breakUpItem);
        }
        return $breakUps;
    }
    
    public static function getChartBreakUp(){
        self::$instance = self::getInstance();
        $query = self::$pdo->prepare("CALL getBreakupByCategory()");
        $query->execute();
        $chartBreakUps = "[";
        $colorCounter = 0;
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $chartBreakUps .= "{value : ".$row['total'].", color : '".self::$colors[$colorCounter++]."'}, ";
        }
        $chartBreakUps .= "]";
        return $chartBreakUps;
    }
    
    //====================================== CATEGORIES ======================================
    
    /**
     * Creates an array of Category Objects
     *
     * @return array of 'Category' Objects
     */
    public static function getAllCategories(){
        self::$instance = self::getInstance();
        $query = self::$pdo->prepare("SELECT `id`, `categoryName` FROM `category`");
        $query->execute();
       
        $categories = array();
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category($row['categoryName'], $row['id']);
            array_push($categories, $category);
        }
        
        return $categories;
    }
    
    //====================================== BANKS ======================================
    
    /**
     * Creates an array of Bank Objects
     *
     * @return array of 'Bank' Objects
     */
    public static function getAllBanks(){
        self::$instance = self::getInstance();
        $query = self::$pdo->prepare("SELECT `id`, `bankName` FROM `bank`");
        $query->execute();
       
        $banks = array();
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $bank = new Bank($row['bankName'], $row['id']);
            array_push($banks, $bank);
        }
        
        return $banks;
    }
    
    //====================================== PAYMENT MODES ======================================
    
    /**
     * Creates an array of PaymentModes Objects
     *
     * @return array of 'PaymentMode' Objects
     */
    public static function getAllPaymentModes(){
        self::$instance = self::getInstance();
        $query = self::$pdo->prepare("SELECT `id`, `modeName` FROM `paymentMode`");
        $query->execute();
       
        $paymentModes = array();
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $paymentMode = new PaymentMode($row['modeName'], $row['id']);
            array_push($paymentModes, $paymentMode);
        }
        
        return $paymentModes;
    }
}
?>
