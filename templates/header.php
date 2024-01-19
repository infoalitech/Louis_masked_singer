<?php
$homePath = '/louis_masked_singer';
session_start(); // Start the session

include_once '../config/database.php'; // include_once the configuration file
include_once '../classes/Auth.php'; // Include your Auth class
use classes\Auth;

// Check if the user is not logged in, redirect to the login page
// if (!Auth::isLoggedIn()) {
//     header('Location: login.php');
//     exit();
// }

// print_r(isset($_SESSION['user_id']));
// Set error reporting
$rootPath = $_SERVER['DOCUMENT_ROOT'];


if ($errorReportingConfig['display_errors']) {
    error_reporting($errorReportingConfig['error_reporting']);
    ini_set('display_errors', 1);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Game Title</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom styles if any -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">TMS LBSYS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $homePath; ?>/index.php">Home</a>
                </li>
                <?php
                    // Navigation will be displayed only if the user is logged in
                    if (isset($_SESSION['user_id'])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $homePath; ?>/round/index.php">Rounds</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $homePath; ?>/clip/index.php">Clips</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $homePath; ?>/celebrity/index.php">Celebrities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $homePath; ?>/user/index.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $homePath; ?>/auth/logout.php">Logout</a>
                </li>
                <?php
                    }else{
                ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $homePath; ?>/auth/logout.php">Login</a>
                </li>
                <?php
                    }
                ?>
                <!-- Add more navigation links as needed -->
            </ul>
        </div>
    </nav>


<div class="container mt-4">
    <?php include_once 'alert.php'; // include_once the alert.php file ?> 

    <!-- Content of the page will go here -->
