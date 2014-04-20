<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         // put your code here
            require_once './init.php';
         
            //$exp = new ExpenseItem('1', "Blah", "12-12-2012", "1", "Blah", 1233, 4321);
            var_dump(ExpenseItem::getExpensesByCategory(1));
        
        ?>
    </body>
</html>
