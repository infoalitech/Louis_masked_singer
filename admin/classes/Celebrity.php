<?php

class Celebrity {
    private $celebrityId;
    private $name;
    private $imageUrl;
    private $description;

    public function __construct($name, $imageUrl, $description) {
        $this->name = $name;
        $this->imageUrl = $imageUrl;
        $this->description = $description;
    }

    public function getCelebrityId() {
        return $this->celebrityId;
    }

    public function setCelebrityId($celebrityId) {
        $this->celebrityId = $celebrityId;
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
}

?>
