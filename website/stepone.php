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
            background: linear-gradient(to right, #3494e6, #ec6ead);
            animation: gradientAnimation 10s ease infinite alternate;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0%;
            }
            100% {
                background-position: 100%;
            }
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            margin-top: 20px;
            animation: fadeIn 2s ease;
        }

        .card {
            background-color: transparent;
            border: none;
        }

        .options-container {
            text-align: center;
            margin-top: 30px;
            animation: fadeIn 2s ease;
        }

        .option-button {
            font-size: 18px;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            background-color: #28a745;
            border: none;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .option-button:hover {
            background-color: #218838;
        }

        .listening-icon {
            display: none;
            position: absolute;
            top: 40%;
            left: 40%;
            font-size: 15vw;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .listening.listening-icon {
            display: block;
        }

        @media (orientation: landscape) {
            video {
                height: 100%;
            }
        }

        img.img-fluid {
            max-height: 60vh;
        }

        img {
            width: -webkit-fill-available;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        video {
                display:none;
            }
    </style>
</head>
<body class="bg-light">

<div class="container  mt-5">
    <h2 class="text-center display-4">Guess the Celebrity!</h2>
    <p class="text-center lead">Watch the clip and choose the correct celebrity:</p>

    <!-- <div class="card mx-auto">
        <img src="<?= $randomRound->getImageUrl(); ?>" class="img img-fluid" alt="round Image">
    </div>

    <video controls>
        <source src="<?php echo $randomClip->getClipUrl(); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video> -->
</div>

<div class="options-container mt-3">
    <?php foreach ($randomOptions as $index => $option): ?>
        <a href="<?php echo ($option->getId() === $correctCelebrity->getId()) ? 'success.php?round_id='.$randomRound->getID().'&clip_id='.$randomClip->getID().'' : 'steptwo.php?round_id='.$randomRound->getID().'&clip_id='.$randomClip->getID().''; ?>">
            <button class="btn btn-info option-button" data-id="<?php echo $index; ?>"><?php echo $index; ?>  <?php echo $option->getName(); ?></button>
        </a>
    <?php endforeach; ?>
</div>

<span class="listening-icon">🎤</span>

<!-- Add Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const recognition = new webkitSpeechRecognition() || new SpeechRecognition();
        recognition.continuous = true;

        const listeningIcon = document.querySelector('.listening-icon');

        recognition.onstart = function () {
            console.log("Speech recognition started");
            console.log("Listening...");
            listeningIcon.classList.add('listening');
        };

        recognition.onresult = function (event) {
            const transcript = event.results[0][0].transcript.trim().toUpperCase();
            console.log("Recognized:", transcript);

            const options = document.querySelectorAll('.option-button');

            options.forEach(option => {
                const optionId = option.getAttribute('data-id');
                if (transcript.includes(optionId)) {
                    option.classList.add('selected');
                } else {
                    option.classList.remove('selected');
                }
            });
        };

        recognition.onend = function () {
            console.log("Speech recognition ended");
            listeningIcon.classList.remove('listening');
        };

        recognition.onerror = function (event) {
            console.error("Speech recognition error:", event.error);
        };

        // Start listening when the document is ready
        recognition.start();
    });
</script>
</body>
</html>
