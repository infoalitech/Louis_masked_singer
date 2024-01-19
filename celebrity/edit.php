<?php
include_once '../templates/header.php';
include_once '../classes/Celebrity.php';

use classes\Celebrity;


// Check if an ID parameter is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $celebrityId = $_GET['id'];

    // Get the existing celebrity details
    $existingCelebrity = Celebrity::getCelebrityById($celebrityId);

    if ($existingCelebrity) {
        // Celebrity found, process the form submission for updating
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);

            // Handle image file upload
            $imageUploadResult = $existingCelebrity->handleImageUpload('image', '../uploads/celebrities/');

            if ($imageUploadResult['success']) {
                $existingCelebrity->setName($name);
                $existingCelebrity->setDescription($description);
                $existingCelebrity->setImageUrl($imageUploadResult['file_path']);

                // Update the celebrity in the database
                if ($existingCelebrity->updateCelebrity($celebrityId)) {
                    $_SESSION['success'] = 'Celebrity updated successfully!';
                    // Redirect to the index page after successful update
                    header('Location: index.php');
                    exit();
                } else {
                    $_SESSION['error'] = 'Error updating the celebrity. Please try again.';
                }
            } else {
                $_SESSION['error'] = $imageUploadResult['error_message'];
            }
        }
    } else {
        $_SESSION['error'] = 'Celebrity not found.';
        header('Location: index.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'Invalid celebrity ID.';
    header('Location: index.php');
    exit();
}
?>

<div class="container mt-3">
    <h2>Update Celebrity</h2>

    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $existingCelebrity->getName(); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required><?= $existingCelebrity->getDescription(); ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Celebrity</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>
