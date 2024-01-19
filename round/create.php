<?php
include_once '../templates/header.php'; // include_once the header template
include_once '../classes/Round.php'; // include_once your Round class file


use classes\Round;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Form submitted, process the data
    $roundName = $_POST['round_name'];

    // Create a new Round instance
    $newRound = new Round();
    $imageUploadResult = $newRound->handleImageUpload('image', '../uploads/rounds/');
    if ($imageUploadResult['success']) {

        $newRound->setImageUrl($imageUploadResult['file_path']);
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
    } else {
        $_SESSION['error'] = $imageUploadResult['error_message'];
    }
}
?>

<div class="container mt-3">
    <h2>Create New Round</h2>

    <form method="post"  enctype="multipart/form-data">
        <div class="form-group" >
            <label for="round_name">Round Name:</label>
            <input type="text" class="form-control" id="round_name" name="round_name" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Round</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; // include_once the footer template ?>
