<?php

class ExpenseItem{
    

    private $expenseId, $category, $itemName, $date, $paymentMode, $bankName, $amount, $checkNumber;

public function getExpenseId() {
    return $this->expenseId;
}
public function setExpenseId($expenseId) {
    $this->expenseId = $expenseId;
}
public function getCategory() {
    return $this->category;
}
public function setCategory($category) {
    $this->category = $category;
}
public function getItemName() {
    return $this->itemName;
}
public function setItemName($itemName) {
    $this->itemName = $itemName;
}
public function getDate() {
    return $this->date;
}
public function setDate($date) {
    $this->date = $date;
}
public function getPaymentMode() {
    return $this->paymentMode;
}
public function setPaymentMode($paymentMode) {
    $this->paymentMode = $paymentMode;
}
public function getBankName() {
    return $this->bankName;
}
public function setBankName($bankName) {
    $this->bankName = $bankName;
}
public function getAmount() {
    return $this->amount;
}
public function setAmount($amount) {
    $this->amount = $amount;
}
public function getCheckNumber() {
    return $this->checkNumber;
}
public function setCheckNumber($checkNumber) {
    $this->checkNumber = $checkNumber;
}

public function __construct($category, $itemName, $date, $paymentMode, $bankName, $amount, $checkNumber, $expenseId = NULL) {
    $this->expenseId = $expenseId;
    $this->category = $category;
    $this->itemName = $itemName;
    $this->date = $date;
    $this->paymentMode = $paymentMode;
    $this->bankName = $bankName;
    $this->amount = $amount;
    $this->checkNumber = $checkNumber;
    
    if (is_null($expenseId)) {
        DB::createNewExpense($category, $itemName, $date, $paymentMode, $bankName, $amount, $checkNumber);
    }
}

public static function getAllExpenses() {
    return DB::getAllExpenses();
}

public static function getExpenseById($id) {
    return DB::getExpenseById($id);
}

public static function getExpensesByCategory($categoryId){
    return DB::getExpensesByCategory($categoryId);
}
    
}

?>
