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
    <title>Congratulations!</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your CSS styles here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            overflow: hidden;
            background: linear-gradient(to right, #4FACFE, #00F2FE);
        }

        .container {
            text-align: center;
            margin-top: 100px;
            color: #fff;
        }

        h2 {
            font-size: 3em;
            margin-bottom: 30px;
            animation: bounce 1s ease-in-out infinite;
        }

        p {
            font-size: 1.5em;
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: #f8d61e;
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
            opacity: 0;
            animation: fall 4s ease-in-out infinite, rotate 4s linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-500px);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(500px);
                opacity: 0;
            }
        }

        @keyframes rotate {
            0%, 100% {
                transform: rotate(0deg);
            }
            50% {
                transform: rotate(180deg);
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container text-center mt-5">
    <div class="container">
        <h2>Congratulations!</h2>
        <p>You successfully guessed the celebrity.</p>
        <a class="btn btn-primary" href="../index.php">Back</a>
    </div>
    <div class="card mx-auto">
        <img src="<?= $randomRound->getImageUrl(); ?>" class="card-img-top" alt="round Image">
        <video controls>
            <source src="<?php echo $randomClip->getRevelClipUrl(); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
</div>




<!-- Confetti Animation -->
<?php for ($i = 0; $i < 50; $i++): ?>
    <div class="confetti" style="left: <?= rand(0, 100) ?>vw; animation-delay: <?= rand(0, 4) ?>s;"></div>
<?php endfor; ?>

<!-- Add Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
