<?php
// namespace classes;
include_once '../classes/Clip.php'; // include_once your user class file
include_once '../classes/Celebrity.php'; // include_once your user class file
include_once '../classes/Round.php'; // include_once your user class file

error_reporting(true);
ini_set('display_errors', 1);
use classes\Round;
use classes\Clip;
use classes\Celebrity;

$round_id = $_GET['round_id'];
$clip_id = $_GET['clip_id'];
$randomRound = Round::getRoundById($round_id);

// Check if $randomRound is null
if ($randomRound === null) {
    // Handle the case where getRandomRound() returns null
    // You might want to display an error message or take other actions
    die("Error: Unable to retrieve a random round.");
}

$randomClip = Clip::getClipById($clip_id);

// Check if $randomClip is null
if ($randomClip === null) {
    // Handle the case where getRandomClipByRound() returns null
    // You might want to display an error message or take other actions
    die("Error: Unable to retrieve a random clip for the selected round.");
}

$correctCelebrity = Celebrity::getCelebrityById($randomClip->getCelebrityId());

// Check if $correctCelebrity is null
if ($correctCelebrity === null) {
    // Handle the case where getCelebrityById() returns null
    // You might want to display an error message or take other actions
    die("Error: Unable to retrieve the correct celebrity.");
}

$allCelebrities = Celebrity::getAllCelebrities();

// Check if $allCelebrities is empty or null
if (empty($allCelebrities)) {
    // Handle the case where getAllCelebrities() returns an empty array or null
    // You might want to display an error message or take other actions
    die("Error: Unable to retrieve the list of celebrities.");
}

$wrongOptions = array_diff_key($allCelebrities, [$correctCelebrity->getId() => '']);

$randomOptions = array_merge([$correctCelebrity], array_slice($wrongOptions, 0, 2));

shuffle($randomOptions);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Celebrity Quiz</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: linear-gradient(to right, #f7bb97, #dd5e89);
            animation: gradientAnimation 10s infinite alternate-reverse;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            100% {
                background-position: 100% 50%;
            }
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border: 5px solid #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            transition: box-shadow 0.3s ease-in-out;
        }

        .options-container {
            text-align: center;
            margin-top: 50px;
        }

        .option-button {
            font-size: 18px;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .option-button:hover {
            background-color: #2c3e50;
        }

        .listening-icon {
            display: none;
            position: absolute;
            top: 40%;
            left: 40%;
            font-size: 15vw;
            color: #fff;
        }

        .listening.listening-icon {
            display: block;
        }

        img {
            display: none;
        }

        button.option-button.selected {
            background: black;
            color: white;
        }
    </style>
</head>
<body class="bg-light">

<div class="container text-center mt-5">
    <h2 style="color: #fff;">Guess the Celebrity!</h2>
    <p style="color: #fff;">Watch the clip and choose the correct celebrity:</p>

    <div class="card mx-auto" style="width: 18rem;">
        <img src="<?= $randomRound->getImageUrl(); ?>" class="card-img-top" alt="round Image">
        <video controls>
            <source src="<?php echo $randomClip->getClipUrl(); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
</div>

<div class="options-container mt-3">
    <a class="btn btn-primary try-again-btn" href="./index.php">Try Again</a>
    <a class="btn btn-primary back-btn" href="../index.php">Back</a>
</div>

<span class="listening-icon">🎤</span>

<!-- Add Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
