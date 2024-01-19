<?php
include_once '../templates/header.php'; // include_once the header template
include_once '../classes/User.php'; // include_once your user class file

use classes\User;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form submitted, process the data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Create a new User instance
    $newUser = new User();
    $newUser->setUsername($username);
    $newUser->setEmail($email);
    $newUser->setPassword($password);
   
    // Save the new user to the database
    if ($newUser->saveUser()) {
        $_SESSION['success'] = 'User created successfully!';
        // Redirect to the index page after successful creation
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error'] = 'Error saving the round. Please try again.';
    }
}
?>

<div class="container mt-3">
    <h2>Create New Round</h2>

    <form method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; // include_once the footer template ?>
