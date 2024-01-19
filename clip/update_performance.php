<?php
include_once '../templates/header.php';
include_once '../classes/Clip.php';
include_once '../classes/Round.php';
include_once '../classes/Celebrity.php';

use classes\Clip;
use classes\Round;
use classes\Celebrity;


// Check if an ID parameter is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $clipId = $_GET['id'];

    // Get the existing clip details
    $existingClip = Clip::getClipById($clipId);

    if ($existingClip) {
        // Clip found, process the form submission for updating
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Handle image file upload
            $imageUploadResult = $existingClip->handleVideoUpload('image', '../uploads/clips/');

            if ($imageUploadResult['success'] ) {
                $existingClip->setClipUrl($imageUploadResult['file_path']); // Store file path instead of URL
                // Update the clip in the database
                if ($existingClip->updateClip($clipId)) {
                    $_SESSION['success'] = 'Clip updated successfully!';
                    // Redirect to the index page after successful update
                    header('Location: index.php');
                    exit();
                } else {
                    $_SESSION['error'] = 'Error updating the clip. Please try again.';
                }
            } else {
                $_SESSION['error'] = $imageUploadResult['error_message'];
            }
        }
    } else {
        $_SESSION['error'] = 'Clip not found.';
        header('Location: index.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'Invalid clip ID.';
    header('Location: index.php');
    exit();
}

// Get all rounds and celebrities for the dropdowns
$rounds = Round::getAllRounds();
$celebrities = Celebrity::getAllCelebrities();
?>

<div class="container mt-3">
    <h2>Update Performance Clip</h2>

    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Clip:</label>
            <input type="file" class="form-control-file" id="image" name="image"  required>
        </div>
        <button type="submit" class="btn btn-primary">Update Clip</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>
