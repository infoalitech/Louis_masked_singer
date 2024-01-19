<?php
include_once '../../templates/header.php';
include_once '../../classes/Round.php';

use classes\Round;

// Check if the round ID is provided in the URL
if (isset($_GET['id'])) {
    $roundId = $_GET['id'];

    // Retrieve the round by ID
    $round = Round::getRoundById($roundId);

    if (!$round) {
        // Handle the case where the round with the specified ID is not found
        echo "Round not found.";
        exit();
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Update the round details based on the submitted form data

        // Assuming you have form fields like 'round_name' for the round name
        $round->setRoundName($_POST['round_name']);

        // Save the updated round details
        if ($round->updateRound($roundId)) {
            // Set a success message in the session
            $_SESSION['success'] = "Round updated successfully!";
            // Redirect back to the index of the round
            header("Location: index.php");
            exit();
           
        } else {
            $_SESSION['error'] = "Error updating the round. Please try again.";

           
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
    <h2>Edit Round</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="round_name">Round Name:</label>
            <input type="text" class="form-control" id="round_name" name="round_name" value="<?php echo $round->getRoundName(); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update Round</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>
