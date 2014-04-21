<?php

class PaymentMode{
    
    private $id;
    private $modeName;
    
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getModeName() {
        return $this->modeName;
    }
    public function setModeName($modeName) {
        $this->modeName = $modeName;
    }

    function __construct($modeName, $id = NULL) {
        $this->id = $id;
        $this->modeName = $modeName;
        
        if ($id === NULL) {
            $this->createPaymentMode($modeName);
        }
    }
    
    public static function getAllPaymentModes() {
        return DB::getAllPaymentModes();
    }
    
}
?>
