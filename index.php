<?php
    require_once './init.php';
    $pageTitle = "Expense Break Up";
    $breakUp = ExpenseItem::getBreakUpByCategory();

    $table = "<table><tr><th>CategoryName</th><th>Amount</th></tr>";
    $total = 0;

    foreach ($breakUp as $breakUpItem) {
        $table .= "<tr><td><a href='expenses.php?categoryId=".$breakUpItem['categoryId']."'>".$breakUpItem['categoryName']."</a></td>";
        $table .= "<td>".number_format($breakUpItem['categoryTotal'])."</td><td style='background:".$breakUpItem['categoryColor'].";width:100px;'></td></tr>";
        $total += $breakUpItem['categoryTotal'];
    }
    $table .= "<tr><td></td><td class='bold'>".number_format($total)."</td></table>";
    
    require_once 'common/menu.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?= $pageTitle; ?></title>
        <script src="js/libs/chart.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="js/index.js"></script>
        <link href="css/common.css" rel="stylesheet"/>
    </head>
    <body>
        <div style="width: 450px;height: 450px;margin: auto;"><canvas id="expenseChart" height="450" width="450"></canvas></div>
        
        <div id="mainContainer">
            <?php
                echo $table;
            ?>
        </div>
        <script src="js/index.js"></script>
    </body>
</html>

