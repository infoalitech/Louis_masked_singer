
<?php
$homePath = '/louis_music/admin';
include_once '../templates/header.php'; // include_once the header template
include_once '../classes/Round.php'; // include_once your Round class file

use classes\Round;
// Retrieve the list of rounds
$rounds = Round::getAllRounds();
// 
?>


<div class="container mt-3">
    <h2>Round List</h2>
    <a href="create.php" class="btn btn-primary mb-2">Create New Round</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rounds as $round) : ?>
                <tr>
                    <td><?= $round->getId(); ?></td>
                    <td><?= $round->getRoundName(); ?></td>
                    <td><img src="<?= $round->getImageUrl(); ?>" alt="round Image" style="max-width: 100px;"></td>
                    <td>
                        <a href="edit.php?id=<?php echo $round->getId(); ?>" class="btn btn-warning btn-sm float-right ml-2">Edit</a>
                        <a href="delete_round.php?id=<?php echo $round->getId(); ?>" class="btn btn-danger btn-sm float-right">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once '../templates/footer.php'; // include_once the footer template ?>
