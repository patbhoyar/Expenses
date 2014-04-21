<?php
    require_once './init.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="css/common.css" rel="stylesheet"/>
    </head>
    <body>
        <div id="mainContainer">
            <?php
            require_once 'common/menu.php';
                $expenses = ExpenseItem::getAllExpenses();

                $table = "<table><tr><th>Category</th><th>Item</th><th>Date</th><th>Amount</th><th>Payment Mode</th><th>Bank</th><th>Check No</th></tr>";
                $total = 0;

                /* @var $expense ExpenseItem */
                foreach ($expenses as $expense) {
                    $table .= "<tr><td class='category'>".$expense->getCategory()."</td>";
                    $table .= "<td class='itemName'>".$expense->getItemName()."</td>";
                    $table .= "<td class='date'>".$expense->getDate()."</td>";
                    $table .= "<td class='amount'>".number_format($expense->getAmount())."</td>";
                    $table .= "<td class='paymentMode'>".$expense->getPaymentMode()."</td>";
                    $table .= is_null($expense->getBankName())?"<td class='bankName'> -- </td>":"<td class='bankName'>".$expense->getBankName()."</td>";
                    $table .= is_null($expense->getCheckNumber())?"<td class='checkNumber'> -- </td>":"<td class='checkNumber'>".$expense->getCheckNumber()."</td></tr>";

                    $total += $expense->getAmount();
                }
                $table .= "<tr><td class='category'></td><td class='itemName'></td><td class='date'></td><td class='bold'>".number_format($total)."</td>";
                $table .= "<td class='paymentMode'></td><td class='bankName'></td><td class='checkNumber'></td></tr></table>";
                echo $table;
            ?>
        </div>
    </body>
</html>
