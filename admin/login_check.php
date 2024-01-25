<?php
// Start or resume a session
session_start();

// Include the database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Protect against SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Hash the password (You should use a more secure hashing method in a real-world scenario)
    $hashed_password = md5($password);

    // Query to check if the user exists
    $query = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Successful login
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Redirect to index.php
        exit();
    } else {
        // Invalid login
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: login.php"); // Redirect back to the login page
        exit();
    }
}

// Close connection (Note: The connection will be automatically closed when the script finishes execution)
?>
