<?php
include ('connection.php');

if (isset($_SESSION['user_logged_in']) && !empty($_SESSION['user_logged_in'])) {
    unset($_SESSION['user_logged_in']);
}
    header('location: login.php');
?>