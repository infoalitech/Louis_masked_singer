<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Your Website Title</title>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Your App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

        <?php
            // Check if the user is logged in, and display the logout button if true
            if (isset($_SESSION['username'])) {
              ?>

            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_word.php">Add Word</a>
            </li>
            <?php
        }
            ?>
            <!-- Add more navigation items as needed -->
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php
            // Check if the user is logged in, and display the logout button if true
            if (isset($_SESSION['username'])) {
                echo '<li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                      </li>';
            }
            ?>
        </ul>
    </div>
</nav>
<?php
    include 'alert.php';


?>



