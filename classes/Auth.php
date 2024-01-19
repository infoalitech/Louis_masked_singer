<?php
namespace classes;

// include_once 'BaseDatabaseModel.php';
include_once 'User.php';

use classes\User;

class Auth {

    // Authenticate user by username and password
    public static function login($username, $password) {
        // Assuming a User class with a method to retrieve a user by username
        $user = User::getUserByUsername($username);

        if ($user && $password == $user->getPassword()) {
            // Password is correct, store user information in session
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            return true;
        }

        // Invalid username or password
        return false;
    }

    // Check if the user is currently logged in
    public static function isLoggedIn() {

        // print_r("test");
        // exit();
        return isset($_SESSION['user_id']);
    }

    // Get the current user's ID
    public static function getUserId() {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    // Get the current user's username
    public static function getUsername() {
        return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    // Log out the current user
    public static function logout() {
        session_unset();
        session_destroy();
    }
}
?>
