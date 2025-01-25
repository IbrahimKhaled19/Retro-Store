<?php
    session_start();
    include("dbcon.php");
    if(isset($_POST['password-update'])) {
        $email            = trim($_POST['email']);
        $new_password     = trim($_POST['password']);
        $confirm_password = trim($_POST['c-password']);
        $token            = trim($_POST['password_token']);

        if(!empty($token)) {
            $check_token = "SELECT token FROM users WHERE token = '$token' LIMIT 1";
            $check_token_run = mysqli_query($con , $check_token);
            if(mysqli_num_rows($check_token_run) > 0) {
                $update_password = "UPDATE users SET password = '$new_password' WHERE token='$token' LIMIT 1";
                $update_password_run = mysqli_query($con , $update_password);
                if($update_password_run) {
                    $_SESSION['status'] = "New Password Successfully Updated. !";
                    header("Location: login.php");
                    exit(0);
                }else {
                    $_SESSION['status'] = "Did not update password. Something went wrong";
                    header("Location: password-reset.php");
                    exit(0);
                }
            }else {
                $_SESSION['status'] = "Invaild Token";
                header("Location: password-reset.php");
                exit(0);
            }
        }else {
            $_SESSION['status'] = "No Token Avilable";
            header("Location: password-reset.php");
            exit(0);
        }
    }