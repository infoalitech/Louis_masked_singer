<?php
namespace classes;

include_once 'BaseDatabaseModel.php';


// Example usage in Round class
class Round extends BaseDatabaseModel {
    protected static $tableName = 'rounds'; // Specify the table name
    public $id;
    public $roundName;
    public $imageUrl;
    
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



    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
    }

    /**
     * Get a random round from the available clips
     * 
     * @return Clip|null The random clip, or null if no clips available
     */
    public static function getRandomRound()
    {
        $allRounds = self::getAllRounds();

        // Check if there are any clips available
        if (empty($allRounds)) {
            return null; // No clips available
        }

        // Get a random clip from the array of all clips
        $randomIndex = array_rand($allRounds);
        $randomRoundId = $allRounds[$randomIndex]->getId();

        // Return the random clip
        return self::getRoundById($randomRoundId);
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
    public function delete($id) {
        return $this->delete($id);
    }
  
}

?>
