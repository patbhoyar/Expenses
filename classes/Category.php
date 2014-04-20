<?php
class Category{

    private $id;
    private $categoryName;

    public function __construct($categoryName, $id = NULL) {
        $this->id = $id;
        $this->categoryName = $categoryName;
        
        if ($id === NULL) {
            $this->createCategory($categoryName);
        }
    }
    
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getCategoryName() {
        return $this->categoryName;
    }
    public function setCategoryName($categoryName) {
        $this->categoryName = $categoryName;
    }

    private function createCategory($categoryName){
        //DB::createCategory($categoryName);
    }


    public static function getAllCategories(){
        return DB::getAllCategories();
    }

}
?>
