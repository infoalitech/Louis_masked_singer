<?php
namespace classes;



require_once '../config/database.php';
class DatabaseManager {
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    public function __construct() {
       
        global $databaseConfig;

        $this->host = $databaseConfig['host'];
        $this->username = $databaseConfig['username'];
        $this->password = $databaseConfig['password'];
        $this->database = $databaseConfig['database'];
        $this->connect();
    }


    private function connect() {
        // $mysqli = new \mysqli('hostname', 'username', 'password', 'database');

        $this->conn = new \mysqli($this->host, $this->username, $this->password);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $this->createDatabase();
        $this->conn->select_db($this->database);
        $this->createTables();
    }

    private function createDatabase() {
        $sql = "CREATE DATABASE IF NOT EXISTS " . $this->database;
        $this->conn->query($sql);
    }

    public function createTables() {
        $this->createUsersTable();
        $this->createRoundsTable();
        $this->createCelebritiesTable();
        $this->createClipsTable();
        $this->createGuessesTable();
    }

    private function createRoundsTable() {
        $sql = "CREATE TABLE IF NOT EXISTS rounds (
            round_id INT PRIMARY KEY AUTO_INCREMENT,
            round_name VARCHAR(50) NOT NULL
        )";

        $this->conn->query($sql);
    }

    private function createCelebritiesTable() {
        $sql = "CREATE TABLE IF NOT EXISTS celebrities (
            celebrity_id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            image_url VARCHAR(255) NOT NULL,
            description TEXT
        )";

        $this->conn->query($sql);
    }

    private function createClipsTable() {
        $sql = "CREATE TABLE IF NOT EXISTS clips (
            clip_id INT PRIMARY KEY AUTO_INCREMENT,
            round_id INT,
            celebrity_id INT,
            clip_url VARCHAR(255) NOT NULL,
            FOREIGN KEY (round_id) REFERENCES rounds(round_id),
            FOREIGN KEY (celebrity_id) REFERENCES celebrities(celebrity_id)
        )";

        $this->conn->query($sql);
    }

    private function createGuessesTable() {
        $sql = "CREATE TABLE IF NOT EXISTS guesses (
            guess_id INT PRIMARY KEY AUTO_INCREMENT,
            round_id INT,
            player_name VARCHAR(50) NOT NULL,
            guessed_celebrity_id INT,
            is_correct BOOLEAN NOT NULL,
            FOREIGN KEY (round_id) REFERENCES rounds(round_id),
            FOREIGN KEY (guessed_celebrity_id) REFERENCES celebrities(celebrity_id)
        )";

        $this->conn->query($sql);
    }


    private function createUsersTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            user_id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) NOT NULL
            -- Add other fields as needed
        )";

        $this->conn->query($sql);
    }

    public function closeConnection() {
        $this->conn->close();
    }
    public function getConn() {
        return $this->conn;
    }
}

// Usage example:
// $host = "your_database_host";
// $username = "your_database_username";
// $password = "your_database_password";
// $database = "your_database_name";
// $databaseManager = new DatabaseManager($host, $username, $password, $database);
// $databaseManager->createTables();
// $databaseManager->closeConnection();

?>
