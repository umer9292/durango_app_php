<?php
/**
 * Created by PhpStorm.
 * User: Umer
 * Date: 10/24/2019
 * Time: 12:11 PM
 */
include 'connection.php';

if (!isset($_SESSION['user_logged_in']) && empty($_SESSION['user_logged_in'])) {
    header('location: login.php');
    exit();
}
print_r($_SESSION['user_logged_in']);
?>

<?php include('include/header.php'); ?>

<?php include('include/footer.php'); ?>