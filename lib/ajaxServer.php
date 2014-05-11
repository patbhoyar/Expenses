<?php
require_once '../init.php';
$request = trim($_POST['request']);

if (isset($_POST['request'])) {
    switch ($request) {
        case "addExpense":
            $category = trim($_POST['category']);
            $itemName = trim($_POST['itemName']);
            $date = trim($_POST['date']);
            $newDate = date("Y-m-d", strtotime($date));
            $paymentMode = trim($_POST['modeOfPayment']);
            $bankName = trim($_POST['bank']);
            $amount = trim($_POST['amount']);
            $checkNumber = trim($_POST['checkNumber']);
            $exp = new ExpenseItem($category, $itemName, $newDate, $paymentMode, $bankName, $amount, $checkNumber);
            var_dump($exp);
            break;
        case "chartBreakUp":
            echo DB::getChartBreakUp();
            break;
        case "allExpenses":
            echo getExpense('getAllExpenses');
            break;
        case 'getExpensesByCategory':
            echo getExpense('getExpensesByCategory', trim($_POST['categoryId']));
            break;
    }
}

function getExpense($param, $cId = null) {
    if (is_null($cId)) {
        $expenses = ExpenseItem::$param();
    }else{
        $expenses = ExpenseItem::$param($cId);
    }
    $data = "[";
    foreach ($expenses as $expense) {
        $data .= $expense.",";
    }
    $data = substr($data, 0, -1);
    $data .= "]";
    return $data;
}

?>
