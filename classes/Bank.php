<?php

class Bank{
    
    private $id;
    private $bankName;
    
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getBankName() {
        return $this->bankName;
    }
    public function setBankName($bankName) {
        $this->bankName = $bankName;
    }

    function __construct($bankName, $id = NULL) {
        $this->id = $id;
        $this->bankName = $bankName;
        
        if ($id === NULL) {
            $this->createBank($bankName);
        }
    }
    
    private static function createBank($bankName){
        
    }

    
    
}
?>
