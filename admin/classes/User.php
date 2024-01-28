<?php
namespace classes;

include 'BaseDatabaseModel.php';

class User extends BaseDatabaseModel {
    protected static $tableName = 'users'; // Specify the table name

    public $id;
    public $username;
    public $password;
    public $email;

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

    // Getter and Setter methods for $username
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    // Getter and Setter methods for $password
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // Getter and Setter methods for $email
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    // Static method to get all users
    public static function getAllUsers() {
        return parent::getAll();
    }

    // Static method to get a user by ID
    public static function getUserById($id) {
        return parent::getById($id);
    }

    // Instance method to save a user
    public function saveUser() {
        print("test");;

        // Check if the required properties have values before saving
        if (empty($this->username) || empty($this->password) || empty($this->email)) {
            return false; // Or handle the error as needed
        }

        return $this->save();
    }

    // Instance method to update a user
    public function updateUser($id) {
        return $this->update($id);
    }
}
?>
