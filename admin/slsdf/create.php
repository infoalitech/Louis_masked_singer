<?php
include '../templates/header.php'; // Include the header template
include '../classes/Round.php'; // Include your Round class file


use classes\Round;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form submitted, process the data
    $roundName = $_POST['round_name'];

    // Create a new Round instance
    $newRound = new Round();
    $newRound->setRoundName($roundName);

    // Save the new round to the database
    if ($newRound->saveRound()) {
        $_SESSION['success'] = 'Round created successfully!';
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
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-group">
            <label for="round_name">Round Name:</label>
            <input type="text" class="form-control" id="round_name" name="round_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Round</button>
    </form>
</div>

<?php include '../templates/footer.php'; // Include the footer template ?>
