
<?php
$homePath = '/louis_masked_singer/admin';
session_start(); // Start the session

// include $homePath.'autoload.php';
// Set error reporting
$rootPath = $_SERVER['DOCUMENT_ROOT'];


include '../config/database.php'; // Include the configuration file





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
    <a class="navbar-brand" href="#">Your Game Logo/Title</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $homePath; ?>/index.php">Home</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="<?php echo $homePath; ?>/round/index.php">Rounds</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="<?php echo $homePath; ?>/user/index.php">Users</a>
            </li>
            <!-- Add more navigation links as needed -->
        </ul>
    </div>
</nav>


<div class="container mt-4">
    <?php include 'alert.php'; // Include the alert.php file ?> 

    <!-- Content of the page will go here -->
