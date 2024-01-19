<?php
include_once '../templates/header.php';
include_once '../classes/Celebrity.php';

use classes\Celebrity;


// Get all celebrities from the database
$celebrities = Celebrity::getAll();

?>

<div class="container mt-3">
    <h2>Celebrities</h2>
    <a href="create.php" class="btn btn-primary mb-2">Create New Celebrity</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($celebrities as $celebrity) : ?>
                <tr>
                    <td><?= $celebrity->getId(); ?></td>
                    <td><?= $celebrity->getName(); ?></td>
                    <td><?= $celebrity->getDescription(); ?></td>
                    <td><img src="<?= $celebrity->getImageUrl(); ?>" alt="Celebrity Image" style="max-width: 100px;"></td>
                    <td>
                        <a href="edit.php?id=<?php echo $celebrity->getId(); ?>" class="btn btn-warning btn-sm float-right ml-2">Edit</a>
                        <a href="delete_celebrity.php?id=<?php echo $celebrity->getId(); ?>" class="btn btn-danger btn-sm float-right">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once '../templates/footer.php'; ?>
