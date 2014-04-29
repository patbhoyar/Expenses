<?php
    require_once './init.php';
    $pageTitle = "Add New Expense";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?= $pageTitle; ?></title>
        <link href="css/common.css" rel="stylesheet"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script>
            $(function() {
                $( "#datepicker" ).datepicker();
            });
        </script>
        <script src="js/addExpense.js"></script>
    </head>
    <body>
        <div id="mainContainer">
            <?php
                require_once 'common/menu.php';
            ?>
            <form name="addExpense">
                <table id="addExpenseTable">
                    <tr>
                        <td class="tableText">Category : </td>
                        <td class="tableValue">
                            <?php
                                $categoriesSelect = "<select id='category'>";
                                $categories = Category::getAllCategories();
                                
                                /* @var $category Category */
                                foreach ($categories as $category) {
                                    $categoriesSelect .= "<option value='".$category->getId()."'>".$category->getCategoryName()."</option>";
                                }
                                $categoriesSelect .= "</select>";
                                echo $categoriesSelect;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="tableText">Item : </td>
                        <td class="tableValue">
                            <input type="text" id="itemName" name="itemName"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="tableText">Date : </td>
                        <td class="tableValue">
                            <input type="text" id="datepicker" name="datepicker">
                        </td>
                    </tr>
                    <tr>
                        <td class="tableText">Amount : </td>
                        <td class="tableValue">
                            <input type="text" name="amount" id="amount"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="tableText">Mode of Payment : </td>
                        <td class="tableValue">
                            <?php
                                $paymentModesSelect = "<select id='paymentMode'>";
                                $paymentModes = PaymentMode::getAllPaymentModes();
                                
                                /* @var $paymentMode PaymentMode */
                                foreach ($paymentModes as $paymentMode) {
                                    $paymentModesSelect .= "<option value='".$paymentMode->getId()."'>".$paymentMode->getModeName()."</option>";
                                }
                                $paymentModesSelect .= "</select>";
                                echo $paymentModesSelect;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="tableText">Bank : </td>
                        <td class="tableValue">
                            <?php
                                $banksSelect = "<select id='bank'>";
                                $banks = Bank::getAllBanks();
                                $banksSelect .= "<option value='0'>None</option>";
                                /* @var $bank Bank */
                                foreach ($banks as $bank) {
                                    $banksSelect .= "<option value='".$bank->getId()."'>".$bank->getBankName()."</option>";
                                }
                                $banksSelect .= "</select>";
                                echo $banksSelect;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="tableText">Check No : </td>
                        <td class="tableValue">
                            <input type="text" name="checkNumber" id="checkNumber"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="button">
                            <input type="button" name="clear" id="clear" value="Clear All"/>
                        </td>
                        <td class="button">
                            <input type="submit" name="submit" id="submit" value="Add Expense"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
