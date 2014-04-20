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
    
    public static function getExpenseById($id){
        self::$instance = self::getInstance();
        $query = self::$pdo->prepare("SELECT `category`, `itemName`, `date`, `paymentMode`, `bankName`, `amount`, `checkNumber` FROM `expense` WHERE id = :id");
        $query->execute(array(':id' => $id));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        
        $expense = new ExpenseItem($data['category'], $data['itemName'], $data['date'], $data['paymentMode'], $data['bankName'], $data['amount'], $data['checkNumber'], $id);
        return $expense;
    }
    
    public static function getExpensesByCategory($categoryId){
        self::$instance = self::getInstance();
        $query = self::$pdo->prepare("SELECT `id`, `category`, `itemName`, `date`, `paymentMode`, `bankName`, `amount`, `checkNumber` FROM `expense` WHERE category = :categoryId");
        $query->execute(array(':categoryId' => $categoryId));
       
        $expenseItems = array();
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $expenseItem = new ExpenseItem($row['category'], $row['itemName'], $row['date'], $row['paymentMode'], $row['bankName'], $row['amount'], $row['checkNumber'], $row['id']);
            array_push($expenseItems, $expenseItem);
        }
        
        return $expenseItems;
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
        $query = self::$pdo->prepare("SELECT `id`, `bankName` FROM `banks`");
        $query->execute();
       
        $categories = array();
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category($row['categoryName'], $row['id']);
            array_push($categories, $category);
        }
        
        return $categories;
    }
}
?>
