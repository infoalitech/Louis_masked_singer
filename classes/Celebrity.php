<?php
namespace classes;

include_once 'BaseDatabaseModel.php';

class Celebrity extends BaseDatabaseModel {
    protected static $tableName = 'celebrities'; // Specify the table name

    public $id;
    public $name;
    public $imageUrl;
    public $description;

    public function __construct() {
        parent::__construct();
    }

    // Getter and Setter methods for $id
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }


    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }


    // Static method to get all users
    public static function getAllCelebrities() {
        return parent::getAll();
    }

    // Static method to get a user by ID
    public static function getCelebrityById($id) {
        return parent::getById($id);
    }

    // Instance method to save a user
    public function saveCelebrity() {

        // Check if the required properties have values before saving
        if (empty($this->name) || empty($this->imageUrl) || empty($this->description)) {
            return false; // Or handle the error as needed
        }

        return $this->save();
    }

    // Instance method to update a user
    public function updateCelebrity($id) {


        return $this->update($id);

    }
    // Instance method to delete a celebrity
    public function delete($id) {
        return $this->delete($id);
    }
}

?>
