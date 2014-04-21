<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require_once './init.php';
         
            $expenses = ExpenseItem::getAllExpenses();
            
            $table = "<table><tr><th>Category</th><th>Item</th><th>Date</th><th>Amount</th><th>Payment Mode</th><th>Bank Name</th><th>Check Number</th></tr>";
            $total = 0;
            
            /* @var $expense ExpenseItem */
            foreach ($expenses as $expense) {
                $table .= "<tr><td>".$expense->getCategory()."</td>";
                $table .= "<td>".$expense->getItemName()."</td>";
                $table .= "<td>".$expense->getDate()."</td>";
                $table .= "<td>".$expense->getAmount()."</td>";
                $table .= "<td>".$expense->getPaymentMode()."</td>";
                $table .= "<td>".$expense->getBankName()."</td>";
                $table .= "<td>".$expense->getCheckNumber()."</td></tr>";
                
                $total += $expense->getAmount();
            }
            $table .= "</table>";
            echo $table;
            echo "<br><br>Total = ".$total;
        ?>
    </body>
</html>
