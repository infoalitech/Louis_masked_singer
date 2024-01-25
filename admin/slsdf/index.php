
<?php
include '../templates/header.php'; // Include the header template
include '../classes/Round.php'; // Include your Round class file

use classes\Round;
// Retrieve the list of rounds
$rounds = Round::getAllRounds();

?>


<div class="container mt-3">
    <h2>Round List</h2>
    <a href="create.php" class="btn btn-primary mb-2">Create New Round</a>
    <ul class="list-group">
        <?php foreach ($rounds as $round) : ?>
            <li class="list-group-item">
                <a href="round_details.php?id=<?php echo $round->getId(); ?>">
                    <?php print_r($round->roundName); ?>
                </a>
                <a href="edit.php?id=<?php echo $round->getId(); ?>" class="btn btn-warning btn-sm float-right ml-2">Edit</a>
                <a href="delete_round.php?id=<?php echo $round->getId(); ?>" class="btn btn-danger btn-sm float-right">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include '../templates/footer.php'; // Include the footer template ?>
