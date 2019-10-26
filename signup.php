<?php
include ('connection.php');

$errors = [];

if (isset($_POST['submit'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $userName = $_POST['userName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['passwrd'];

    foreach ($_POST as $key => $value) {
        if (empty($_POST[$key])) {
            $errors[$key] = $key.'This field is required';
        }
    }

    //  password validation
    if (strlen($password) < 4) {
        $errors['passwrd'] = 'This password is too short';
    } elseif (strlen($password) > 10) {
        $errors['passwrd'] = 'This password is too long';
    }

    //  email validation
    $emailQuery = 'SELECT * FROM users WHERE email = "'.$email.'"';
    $emailExist = mysqli_query($con, $emailQuery) or die(mysqli_error($con));
    if (mysqli_num_rows($emailExist) > 0) {
        $errors['email'] = 'This email is already taken';
    }

    //  userName validation
    $userNameQuery = 'SELECT * FROM users WHERE  userName = "'.$userName.'"';
    $userNameExist = mysqli_query($con, $userNameQuery) or die(mysqli_error($con));
    if (mysqli_num_rows($userNameExist) > 0) {
        $errors['userName'] = 'This your userName is already taken';
    }

    if (count($errors) == 0) {
        $userInsertQuery = 'INSERT INTO users (first_name, last_name, userName, age, gender, email, passwrd)
        VALUE("'.$firstName.'","'.$lastName.'","'.$userName.'","'.$age.'","'.$gender.'","'.$email.'","'.$password.'")';
        $result = mysqli_query($con, $userInsertQuery);
        if ($result) {
            header('location: login.php');
            die('data inserted');
        } else {
            die(mysqli_error($con));
        }
    }
}
?>

<?php include('include/header.php'); ?>
    <div class="signupBg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-12 offset-lg-2 offset-md-3">
                    <?php
                        if(count($errors)>0) {
                            foreach ($errors as $value){ ?>
                        <div class="alert alert-danger" role="alert">
                            <?=$value?>
                        </div>
                    <?php
                            }
                        }
                    ?>
                    <div class="card signupCard">
                        <div class="card-body">
                            <h5 class="card-title signup_title_name">Signup Form</h5>
                            <form action="" method="post">
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" name="first_name" class="form-control signup_form_control" placeholder="First name"
                                        value="<?=(isset($_POST['first_name']) ? ($_POST['first_name']) : '')?>" >
                                    </div>
                                    <div class="col">
                                        <input type="text" name="last_name" class="form-control signup_form_control" placeholder="Last name"
                                        value="<?=(isset($_POST['last_name']) ? ($_POST['last_name']) : '')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="userName" class="form-control signup_form_control" placeholder="Username"
                                    value="<?=(isset($_POST['userName']) ? ($_POST['userName']) : '')?>">
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="number" name="age" class="form-control signup_form_control" placeholder="Enter Age"
                                        value="<?=(isset($_POST['age']) ? ($_POST['age']) : '')?>">
                                    </div>
                                    <div class="col">
                                        <select class="form-control signup_form_control" name="gender" id="exampleFormControlSelect1">
                                            <option selected hidden>Select Gender</option>
                                            <option value="male" <?=(isset($_POST['gender']) && $_POST['gender'] == 'male') ?
                                            'selected' : ''?>
                                            >Male</option>
                                            <option value="female" <?=(isset($_POST['gender']) && $_POST['gender'] == 'female') ?
                                                'selected' : ''?>
                                            >Female</option>
                                            <option value="others" <?=(isset($_POST['gender']) && $_POST['gender'] == 'others') ?
                                                'selected' : ''?>
                                            >Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control signup_form_control" placeholder="Enter email"
                                    value="<?=(isset($_POST['email']) ? ($_POST['email']) : '')?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="passwrd" class="form-control signup_form_control" placeholder="Password"
                                    value="<?=(isset($_POST['passwrd']) ? ($_POST['passwrd']) : '')?>">
                                </div>
                                <div class="text-right">
                                    <a href="login.php" class="signup_link">already have an account</a>
                                </div>
                                <button type="submit" name="submit" value="signup" class="btn submit_btn">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include ('include/footer.php'); ?>
