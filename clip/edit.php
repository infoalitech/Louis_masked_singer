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
            $roundId = htmlspecialchars($_POST['roundId']);
            $celebrityId = htmlspecialchars($_POST['celebrityId']);

            // Handle image file upload
            $imageUploadResult = $existingClip->handleVideoUpload('image', '../uploads/clips/');
            $revealClipUploadResult = $newClip->handleVideoUpload('reveal_image', '../uploads/clips/');

            if ($imageUploadResult['success'] && $revealClipUploadResult['success']) {
                $existingClip->setRoundId($roundId);
                $existingClip->setCelebrityId($celebrityId);
                $existingClip->setClipUrl($imageUploadResult['file_path']); // Store file path instead of URL
                $newClip->setRevelClipUrl($revealClipUploadResult['file_path']); // Store file path instead of URL
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
    <h2>Edit Clip</h2>

    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="roundId">Round:</label>
            <select class="form-control" id="roundId" name="roundId" required>
                <?php foreach ($rounds as $round) : ?>
                    <option value="<?= $round->getId(); ?>" <?= ($existingClip->getRoundId() == $round->getId()) ? 'selected' : ''; ?>>
                        <?= $round->getRoundName(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="celebrityId">Celebrity:</label>
            <select class="form-control" id="celebrityId" name="celebrityId" required>
                <?php foreach ($celebrities as $celebrity) : ?>
                    <option value="<?= $celebrity->getId(); ?>" <?= ($existingClip->getCelebrityId() == $celebrity->getId()) ? 'selected' : ''; ?>>
                        <?= $celebrity->getName(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Clip:</label>
            <input type="file" class="form-control-file" id="image" name="image"  required>
        </div>
        <div class="form-group">
            <label for="reveal_image">Reveal Clip:</label>
            <input type="file" class="form-control-file" id="reveal_image" name="reveal_image"  required>
        </div>
        <button type="submit" class="btn btn-primary">Update Clip</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>
