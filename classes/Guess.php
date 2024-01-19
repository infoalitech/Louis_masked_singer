<?php
namespace classes;

include_once 'BaseDatabaseModel.php';

class Guess extends BaseDatabaseModel {
    protected static $tableName = 'clips'; // Specify the table name

    private $id;
    private $roundId;
    private $playerName;
    private $guessedCelebrityId;
    private $isCorrect;

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

    public function getRoundId() {
        return $this->roundId;
    }

    public function setRoundId($roundId) {
        $this->roundId = $roundId;
    }

    public function getPlayerName() {
        return $this->playerName;
    }

    public function setPlayerName($playerName) {
        $this->playerName = $playerName;
    }

    public function getGuessedCelebrityId() {
        return $this->guessedCelebrityId;
    }

    public function setGuessedCelebrityId($guessedCelebrityId) {
        $this->guessedCelebrityId = $guessedCelebrityId;
    }

    public function isCorrect() {
        return $this->isCorrect;
    }

    public function setCorrect($isCorrect) {
        $this->isCorrect = $isCorrect;
    }

    // Static method to get all users
    public static function getAllGuesses() {
        return parent::getAll();
    }

    // Static method to get a user by ID
    public static function getGuessById($id) {
        return parent::getById($id);
    }

    // Instance method to save a user
    public function saveGuess() {

        // Check if the required properties have values before saving
        if (empty($this->roundId) || empty($this->playerName) || empty($this->guessedCelebrityId)  || empty($this->isCorrect)) {
            return false; // Or handle the error as needed
        }
        
        return $this->save();
    }

    // Instance method to update a user
    public function updateGuess($id) {
        return $this->update($id);
    }
}

?>
