<?php

class Clip {
    private $clipId;
    private $roundId;
    private $celebrityId;
    private $clipUrl;

    public function __construct($roundId, $celebrityId, $clipUrl) {
        $this->roundId = $roundId;
        $this->celebrityId = $celebrityId;
        $this->clipUrl = $clipUrl;
    }

    public function getClipId() {
        return $this->clipId;
    }

    public function setClipId($clipId) {
        $this->clipId = $clipId;
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
}

?>
