<?php
namespace classes;

include 'BaseDatabaseModel.php';


// Example usage in Round class
class Round extends BaseDatabaseModel {
    protected static $tableName = 'rounds'; // Specify the table name
    public $id;
    public $roundName;
    
    public function __construct() {
        parent::__construct();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getRoundName() {
        return $this->roundName;
    }

    public function setRoundName($roundName) {
        $this->roundName = $roundName;
    }


    public static function getAllRounds() {
        return parent::getAll();
    }

    public static function getRoundById($id) {
        return parent::getById($id);
    }

    public function saveRound() {
        // Check if the required property has a value before saving
        if (empty($this->roundName)) {
            return false; // Or handle the error as needed
        }

        return $this->save();
    }

    public function updateRound($id) {
        return $this->update($id);
    }

  
}

?>
