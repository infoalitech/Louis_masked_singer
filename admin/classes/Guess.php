<?php

class Guess {
    private $guessId;
    private $roundId;
    private $playerName;
    private $guessedCelebrityId;
    private $isCorrect;

    public function __construct($roundId, $playerName, $guessedCelebrityId, $isCorrect) {
        $this->roundId = $roundId;
        $this->playerName = $playerName;
        $this->guessedCelebrityId = $guessedCelebrityId;
        $this->isCorrect = $isCorrect;
    }

    public function getGuessId() {
        return $this->guessId;
    }

    public function setGuessId($guessId) {
        $this->guessId = $guessId;
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
}

?>
