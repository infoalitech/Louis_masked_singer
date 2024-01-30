<?php
// Include the necessary files and start the session
include_once '../classes/Auth.php'; // Include your Auth class
use classes\Auth;

// Log out the current user
Auth::logout();

// Redirect to the login page or any other page after logout
header('Location: login.php');
exit();
?>
