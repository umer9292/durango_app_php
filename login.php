<?php
    include('connection.php');

    if(isset($_SESSION['user_logged_in']) && !empty($_SESSION['user_logged_in'])) {
        header('location: dashboard.php');
        exit();
    }

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['passwrd'];

        $hashed = hash('sha512', $password);
        $sql = 'SELECT * FROM users WHERE email= "'.$email.'" AND passwrd= "'.$hashed.'"';
        $query = mysqli_query($con, $sql) or die(mysqli_error($con));
        if (mysqli_num_rows($query) == 1) {
            $user = mysqli_fetch_array($query, true);
            $_SESSION['user_logged_in'] = [
                'user_id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'userName' => $user['userName'],
                'email' => $user['email']
            ];
            header('location: dashboard.php');
            exit();
        } else {
            die('wrong email & password');
        }
    }
?>

<?php include ('include/header.php'); ?>
<div class="loginBg">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 offset-lg-4 offset-md-3">
                <div class="card loginCard">
                    <div class="card-body">
                        <h5 class="card-title login_title_name">Login</h5>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control login_form_control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="passwrd" class="form-control login_form_control" id="exampleInputPassword1" placeholder="Enter your password">
                            </div>
                            <div class="text-right">
                                <a href="signup.php">create new account</a>
                            </div>
                            <button type="submit" name="submit" class="btn btn-block login_btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ('include/footer.php'); ?>
