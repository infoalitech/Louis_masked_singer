<?php
include_once '../templates/header.php'; // include_once the header template
include_once '../classes/User.php'; // include_once your user class file

use classes\User;
// Check if the round ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $newUser = User::getUserById($userId);

    if (!$newUser) {
        // Handle the case where the round with the specified ID is not found
        echo "User not found.";
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Form submitted, process the data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];


        $newUser->setUsername($username);
        $newUser->setEmail($email);
        $newUser->setPassword($password);
    
        // Save the new user to the database
        if ($newUser->updateUser($newUser->getId())) {
            $_SESSION['success'] = 'User updated successfully!';
            // Redirect to the index page after successful creation
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['error'] = 'Error saving the round. Please try again.';
        }
    }
} else {
    // Redirect or display an error message if the round ID is not provided
    $_SESSION['error'] = "Round ID is missing.";
    header("Location: index.php"); // Redirect to index with error message
    exit();
}
?>

<div class="container mt-3">
    <h2>Edit User</h2>

    <form method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $newUser->getEmail(); ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $newUser->getUsername(); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $newUser->getPassword(); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; // include_once the footer template ?>
