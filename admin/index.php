<?php
session_start(); // Start the session

include_once 'templates/header.php'; // include_once the header template
include_once 'alert.php'; // include_once the alert.php file
?>

<div class="jumbotron text-center">
    <h1 class="display-4 animate__animated animate__fadeIn">Welcome to the Round Game!</h1>
    <p class="lead animate__animated animate__fadeIn">This is a simple web application for playing the Round Game.</p>
    <hr class="my-4 animate__animated animate__fadeIn">
    <p class="animate__animated animate__fadeIn">Get started by exploring the rounds or creating a new one.</p>
    <a class="btn btn-primary btn-lg animate__animated animate__fadeIn animate__hover__pulse" href="website/index.php" role="button">Explore Rounds</a>
</div>

<?php include_once 'templates/footer.php'; // include_once the footer template ?>
