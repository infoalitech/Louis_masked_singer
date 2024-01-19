<?php
include_once '../templates/header.php';
include_once '../classes/Celebrity.php';

use classes\Celebrity;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form submitted, process the data
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);

    $newCelebrity = new Celebrity();
    $imageUploadResult = $newCelebrity->handleImageUpload('image', '../uploads/celebrities/');
    if ($imageUploadResult['success']) {
        // Image uploaded successfully, create a new Celebrity instance

        $newCelebrity->setName($name);
        $newCelebrity->setDescription($description);
        $newCelebrity->setImageUrl($imageUploadResult['file_path']);

        // Save the new celebrity to the database
        if ($newCelebrity->saveCelebrity()) {
            $_SESSION['success'] = 'Celebrity created successfully!';
            // Redirect to the index page after successful creation
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['error'] = 'Error saving the celebrity. Please try again.';
        }
    } else {
        $_SESSION['error'] = $imageUploadResult['error_message'];
    }
}

?>

<div class="container mt-3">
    <h2>Create New Celebrity</h2>

    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Celebrity</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>
