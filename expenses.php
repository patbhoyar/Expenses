<?php
    require_once './init.php';
    $pageTitle = "All Expenses";
    
//    if (!isset($_GET['categoryId'])) {
//        $expenses = ExpenseItem::getAllExpenses();
//    }else{
//        $expenses = ExpenseItem::getExpensesByCategory(trim($_GET['categoryId']));
//    }

    $table = "<table id='expensesTable'><tr><th id='categoryHeader'>Category</th><th id='itemNameHeader'>Item</th><th id='dateHeader'>Date</th><th id='amountHeader'>Amount</th>";
    $table .= "<th id='paymentModeHeader'>Payment Mode</th><th id='bankHeader'>Bank</th><th id='checkHeader'>Check No</th></tr></table>";

    require_once 'common/menu.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?= $pageTitle; ?></title>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="js/libs/util.js" type="text/javascript"></script>
        <script src="js/expenses.js" type="text/javascript"></script>
        <link href="css/common.css" rel="stylesheet"/>
    </head>
    <body>
        <div id="mainContainer">
            <?php
                
                echo $table;
            ?>
        </div>
    </body>
</html>
