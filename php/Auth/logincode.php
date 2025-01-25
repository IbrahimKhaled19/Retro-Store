<?php

session_start();
include('dbcon.php');

if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $password = mysqli_real_escape_string($con, trim($_POST['password']));

    $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        $row = mysqli_fetch_array($login_query_run);

        if ($row['verify_status'] == "1") {
            $_SESSION['authenticated'] = TRUE;
            $_SESSION['user_id'] = $row['id'];

            $_SESSION['auth_user'] = [
                'username' => $row['username'],
                'email' => $row['email'],
            ];

            $_SESSION['status'] = "You are Logged In Successfully";
            // Redirect to the products page
            header("Location: http://localhost/web/Sources/php/Product/index.php");
            exit(0);
        } else {
            $_SESSION['status'] = "Please Verify Your Email Account To Login!";
            header("Location: login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "Invalid Email or Password";
        header("Location: login.php");
        exit(0);
    }
}
?>
