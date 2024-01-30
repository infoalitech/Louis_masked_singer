<?php
// Include the necessary files and start the session
include_once '../templates/header.php';
include_once '../classes/Auth.php'; // Include your Auth class
use classes\Auth;

// Check if the user is already logged in, redirect to home if true
if (Auth::isLoggedIn()) {
    header('Location: index.php');
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Attempt to log in
    if (Auth::login($username, $password)) {
        // Redirect to the home page after successful login
        header('Location: ../index.php');
        exit();
    } else {
        $loginError = 'Invalid username or password';
    }
}
?>

<div class="container mt-3">
    <h2>Login</h2>

    <?php if (isset($loginError)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $loginError; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; // Include your footer template ?>
