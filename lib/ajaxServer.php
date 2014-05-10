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
            $expenses = DB::getAllExpenses();
            $data = "[";
            foreach ($expenses as $expense) {
                $data .= $expense.",";
            }
            $data = substr($data, 0, -1);
            $data .= "]";
            echo $data;
            break;
    }
}

?>
