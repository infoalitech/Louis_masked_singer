
<?php
include '../templates/header.php'; // Include the header template
include '../classes/User.php'; // Include your user class file

use classes\User;
// Retrieve the list of users
$users = User::getAll();

?>


<div class="container mt-3">
    <h2>user List</h2>
    <a href="create.php" class="btn btn-primary mb-2">Create New user</a>
    <ul class="list-group">
        <?php foreach ($users as $user) : ?>
            <li class="list-group-item">
                <a href="create.php?id=<?php echo $user->getId(); ?>">
                    <?php print_r($user->username); ?>
                </a>
                <a href="edit.php?id=<?php echo $user->getId(); ?>" class="btn btn-warning btn-sm float-right ml-2">Edit</a>
                <a href="delete_user.php?id=<?php echo $user->getId(); ?>" class="btn btn-danger btn-sm float-right">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include '../templates/footer.php'; // Include the footer template ?>
