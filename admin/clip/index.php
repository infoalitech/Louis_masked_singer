<?php
include_once '../templates/header.php';
include_once '../classes/Clip.php';

use classes\Clip;


// Get all clips from the database
$clips = Clip::getAll();

?>

<div class="container mt-3">
    <h2>Clips</h2>
    <a href="create.php" class="btn btn-primary mb-2">Create New Clip</a>

    <?php
    // Display success or error messages if any
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Round</th>
                <th>Celebrity</th>
                <th>Clip URL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clips as $clip) : ?>
                <tr>
                    <td><?= $clip->getId(); ?></td>
                    <td><?= $clip->getRound()->getRoundName(); ?></td> <!-- Updated to fetch Round name -->
                    <td><?= $clip->getCelebrity()->getName(); ?></td> <!-- Updated to fetch Celebrity name -->
                    <td>
                        <video width="320" height="240" controls>
                            <source src="<?= $clip->getClipUrl(); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo $clip->getId(); ?>" class="btn btn-warning btn-sm float-right ml-2">Edit</a>
                        <a href="delete_clip.php?id=<?php echo $clip->getId(); ?>" class="btn btn-danger btn-sm float-right">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once '../templates/footer.php'; ?>
