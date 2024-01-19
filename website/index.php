<?php
// namespace classes;
include_once '../classes/Round.php'; // include_once your user class file
include_once '../classes/Clip.php'; // include_once your user class file
include_once '../classes/Celebrity.php'; // include_once your user class file

use classes\Round;
use classes\Clip;
use classes\Celebrity;

$randomRound = Round::getRandomRound();

// Check if $randomRound is null
if ($randomRound === null) {
    // Handle the case where getRandomRound() returns null
    // You might want to display an error message or take other actions
    die("Error: Unable to retrieve a random round.");
}

$randomClip = Clip::getRandomClipByRound($randomRound->getId());

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
            /* Gradient background */
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

        .container {
            text-align: center;
            margin-top: 5%;
            animation: fadeIn 2s ease;
        }

        h2, p {
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* or use "cover" for a different effect */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            margin-top: 20px;
            animation: fadeIn 2s ease;
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
    </style>
</head>
<body>

<div class="container">
    <h2 class="display-4">Guess the Celebrity!</h2>
    <video  controls autoplay  id="myVideo">
        <source src="<?php echo $randomClip->getClipUrl(); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>


<script>

    var video = document.getElementById('myVideo');
    
    // Function to play the video
    function playVideo() {
        video.play();
    }

    // Check if autoplay is allowed
    var autoplayAllowed = false;

    // Try to play the video immediately
    video.play().then(function() {
        autoplayAllowed = true;
    }).catch(function(error) {
        // Autoplay not allowed, handle accordingly
        console.log('Autoplay not allowed:', error);
    });

    // If autoplay is not allowed, add a play button and play the video on click
        // if (!autoplayAllowed) {
        //     var playButton = document.createElement('button');
        //     playButton.textContent = 'Play';
        //     playButton.addEventListener('click', playVideo);

        //     // Append the play button
        //     video.parentNode.insertBefore(playButton, video);

        //     // Remove the default controls (optional)
        //     // video.removeAttribute('controls');
        // }

    var video = document.getElementById('myVideo');

    video.addEventListener('ended', function() {
        // Assuming you have PHP variables $randomRound and $randomClip available
        // Adjust the PHP variables accordingly based on your actual code
        var roundId = <?php echo $randomRound->getID(); ?>;
        var clipId = <?php echo $randomClip->getID(); ?>;
        
        // Construct the URL with the PHP variables
        var nextUrl = 'stepone.php?round_id=' + roundId + '&clip_id=' + clipId;
        
        // Redirect to the next page
        window.location.href = nextUrl;
    });
</script>

<!-- Add Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
