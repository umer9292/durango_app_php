<?php
include('connection.php');

if(!isset($_SESSION['user_logged_in']) && empty($_SESSION['user_logged_in'])) {
    header('location: login.php');
    exit();
}

    if (isset($_POST['update'])) {
        $password = $_POST['passwrd'];
        $newPassword = $_POST['new_passwrd'];
        $confirmPassword = $_POST['confirm_password'];

    if ($newPassword == $confirmPassword) {
        $sql = 'SELECT * FROM users WHERE id = "'.$_SESSION['user_logged_in']['user_id'].'"';
        $query = mysqli_query($con, $sql) or die(mysqli_error($con));
        if (mysqli_num_rows($query) == 1) {
            $user = mysqli_fetch_array($query, true);

            $hashed = hash('sha512', $newPassword);
            $updateSql = 'UPDATE users SET 
            passwrd = "'.$hashed.'",
            updated_at = "'.date('Y-m-d h:i:s').'"
            where id = "'.$_SESSION['user_logged_in']['user_id'].'"';
            $updateQuery = mysqli_query($con, $updateSql) or die(mysqli_error($con));

        } else {
            die('current password is wrong');
        }
    }
        header('location: dashboard.php');
}
?>

<?php include ('include/header.php'); ?>
<div class="updatePaswrdBg">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 offset-lg-4 offset-md-3">
                <div class="card updatePaswrdCard">
                    <div class="card-body">
                        <h5 class="card-title updatePaswrd_title_name">Change Password</h5>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="password" name="password" class="form-control updatePaswrd_form_control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="new_passwrd" class="form-control updatePaswrd_form_control" placeholder="New password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="confirm_passwrd" class="form-control updatePaswrd_form_control" placeholder="Confirm password">
                            </div>
                            <button type="submit" name="update" value="update" class="btn btn-block btn-secondary update_btn">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ('include/footer.php'); ?>
