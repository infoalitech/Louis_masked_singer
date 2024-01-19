<?php
namespace classes;

include_once 'BaseDatabaseModel.php';
include_once 'Round.php';
include_once 'Celebrity.php';
use classes\Round;
use classes\Celebrity;
class Clip extends BaseDatabaseModel {
    protected static $tableName = 'clips'; // Specify the table name

    public $id;
    public $roundId;
    public $celebrityId;
    public $clipUrl;
    public $revelClipUrl;


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

    public function getCelebrityId() {
        return $this->celebrityId;
    }

    public function setCelebrityId($celebrityId) {
        $this->celebrityId = $celebrityId;
    }

    public function getClipUrl() {
        return $this->clipUrl;
    }

    public function setClipUrl($clipUrl) {
        $this->clipUrl = $clipUrl;
    }

    public function getRevelClipUrl() {
        return $this->revelClipUrl;
    }

    public function setRevelClipUrl($revelClipUrl) {
        $this->revelClipUrl = $revelClipUrl;
    }
    public static function getRandomClip() {
        $allClips = self::getAllClips();

        // Check if there are any clips available
        if (empty($allClips)) {
            return null; // No clips available
        }



        // Get a random clip from the array of all clips
        $randomIndex = array_rand($allClips);
        $randomClipId = $allClips[$randomIndex]->getId();

        // Return the random clip
        return self::getClipById($randomClipId);
    }
    public static function getRandomClipByRound($value) {

        $allClips = self::getByColumn('round_id', $value);
 
        // Check if there are any clips available
        if (empty($allClips)) {
            return null; // No clips available
        }

        // Get a random clip from the array of all clips
        $randomIndex = array_rand($allClips);
        $randomClipId = $allClips[$randomIndex]->getId();

        // Return the random clip
        return self::getClipById($randomClipId);
    }


    
    // Static method to get all users
    public static function getAllClips() {
        return parent::getAll();
    }

    // Static method to get a user by ID
    public static function getClipById($id) {
        return parent::getById($id);
    }

    // Instance method to save a user
    public function saveClip() {

        // Check if the required properties have values before saving
        if (empty($this->roundId) || empty($this->celebrityId) || empty($this->clipUrl)) {
            return false; // Or handle the error as needed
        }

        return $this->save();
    }

    // Instance method to update a user
    public function updateClip($id) {
        return $this->update($id);
    }
    public function delete($id) {
        return $this->delete($id);
    }

    // Get the associated Round for the clip
    public function getRound() {
        // Check if roundId is set
        if (!empty($this->roundId)) {
            // Use Round class to get the Round instance
            return Round::getRoundById($this->roundId);
        }
        return null;
    }

    // Get the associated Celebrity for the clip
    public function getCelebrity() {
        // Check if celebrityId is set
        if (!empty($this->celebrityId)) {
            // Use Celebrity class to get the Celebrity instance
            return Celebrity::getCelebrityById($this->celebrityId);
        }
        return null;
    }

}

?>
