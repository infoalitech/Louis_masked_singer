<?php
include_once '../templates/header.php';
include_once '../classes/Clip.php';
include_once '../classes/Round.php';
include_once '../classes/Celebrity.php';

use classes\Clip;
use classes\Round;
use classes\Celebrity;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form submitted, process the data
    $roundId = htmlspecialchars($_POST['roundId']);
    $celebrityId = htmlspecialchars($_POST['celebrityId']);

    // Handle image file upload
    $newClip = new Clip();
    $imageUploadResult = $newClip->handleVideoUpload('image', '../uploads/clips/');
    if ($imageUploadResult['success']) {
        // Image uploaded successfully, create a new Clip instance
        $newClip = new Clip();
        $newClip->setRoundId($roundId);
        $newClip->setCelebrityId($celebrityId);
        $newClip->setClipUrl($imageUploadResult['file_path']); // Store file path instead of URL

        // Save the new clip to the database
        if ($newClip->saveClip()) {
            $_SESSION['success'] = 'Clip created successfully!';
            // Redirect to the index page after successful creation
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['error'] = 'Error saving the clip. Please try again.';
        }
    } else {
        $_SESSION['error'] = $imageUploadResult['error_message'];
    }
}

// Get all rounds and celebrities for the dropdowns
$rounds = Round::getAllRounds();
$celebrities = Celebrity::getAllCelebrities();
?>

<div class="container mt-3">
    <h2>Create New Clip</h2>

  

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="roundId">Round:</label>
            <select class="form-control" id="roundId" name="roundId" required>
                <?php foreach ($rounds as $round) : ?>
                    <option value="<?= $round->getId(); ?>"><?= $round->getRoundName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="celebrityId">Celebrity:</label>
            <select class="form-control" id="celebrityId" name="celebrityId" required>
                <?php foreach ($celebrities as $celebrity) : ?>
                    <option value="<?= $celebrity->getId(); ?>"><?= $celebrity->getName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image"  required>
        </div>
        <button type="submit" class="btn btn-primary">Create Clip</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>
