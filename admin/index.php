<?php
session_start(); // Start the session

include 'templates/header.php'; // Include the header template
include 'alert.php'; // Include the alert.php file
?>

<div class="jumbotron">
    <h1 class="display-4">Welcome to the Round Game!</h1>
    <p class="lead">This is a simple web application for playing the Round Game.</p>
    <hr class="my-4">
    <p>Get started by exploring the rounds or creating a new one.</p>
    <a class="btn btn-primary btn-lg" href="round/index.php" role="button">Explore Rounds</a>
</div>

<?php include 'templates/footer.php'; // Include the footer template ?>
