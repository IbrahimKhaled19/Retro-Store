<?php
    session_start();
    include("dbcon.php");
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    function send_password_reset ($name , $email , $token) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = "smtp.gmail.com";
        $mail->Username = "storeretro747@gmail.com";
        $mail->Password = "izbh mjvd eqqe msqb";

        $mail->SMTPSecure = "tls";
        $mail->Port = 587;

        $mail->setFrom("storeretro747@gmail.com", "retroStore");
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Password Reset";

        $email_template = "<h2>Reset Your Password</h2><h5>Reset your password with the below given link</h5><br/><br/><a href='http://localhost/web/Sources/php/Auth/password-change.php?token=$token&email=$email'> Click Me </a>";
        $mail->Body = $email_template;
        $mail->send();

        echo "Message has been sent";
    }
    if(isset($_POST['reset_btn'])) {
        $email = trim($_POST['email']);
        $token = md5(rand());
        
        $check_email = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
        $check_email_run = mysqli_query($con , $check_email);

        if(mysqli_num_rows($check_email_run) > 0) {
            $row = mysqli_fetch_array($check_email_run);
            $get_name = $row['user'];
            $get_email = $row['email'];

            $update_token = "UPDATE users SET token = '$token' WHERE email = '$email'";
            $update_token_run = mysqli_query($con , $update_token);

            if($update_token_run) {
                send_password_reset($get_name , $get_email, $token);
                $_SESSION['status'] = "We emailed you a password reset link";
                header("Location: password-reset.php"); 
                exit(0);

            }else {
                 $_SESSION['status'] = "Something went wrong . #1";
                 header("Location: password-reset.php"); 
                 exit(0);
            }
            
        }else {
           $_SESSION['status'] = "No Email Found";
           header("Location: password-reset.php"); 
            exit(0);
        }
    }