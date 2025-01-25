<?php
    session_start();
    include('dbcon.php');
    
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    class User {
        private $user_name;
        private $user_email;
        private $user_password;

        function set_userName($user_name) {
            $this->user_name = trim($user_name);
            return $this->user_name;
        }
        function set_userEmail($user_email) {
            $this->user_email = trim($user_email);
            return $this->user_email;
        }
        function set_userPassword($user_password) {
            $this->user_password = trim($user_password);
            return $this->user_password;
        }

        function get_userName() {
            return $this->user_name;
        }
        function get_userEmail() {
            return $this->user_email;
        }
        function get_userPassword() {
            return $this->user_password;
        }
        function sendemail_verify($name, $email , $token) {
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
            $mail->Subject = "Email Verification from Retro Store";

            $email_template = "<h2>You have registered with Retro Store</h2> <h5>Verify your email address to login with the below given link</h5><br/><br/><a href='http://localhost/web/Sources/php/Auth/verify-email.php?token=$token'> Click Me </a>";
            $mail->Body = $email_template;
            $mail->send();

            echo "Message has been sent";
        }
    }
    if(isset($_POST['register_btn'])) {
        $user = new User();
        $user->set_userName($_POST['user']);
        $user->set_userEmail($_POST['email']);
        $user->set_userPassword($_POST['password']);
        
        $user_userName  = $user->get_userName();
        $user_userEmail = $user->get_userEmail();
        $user_userPassword = $user->get_userPassword(); 
        $token = md5(rand());
        
        // check email exists or not
        $check_email_query = "SELECT email FROM users WHERE email = '$user_userEmail' LIMIT 1";
        $check_email_query_run = mysqli_query($con , $check_email_query);
        
        if(mysqli_num_rows($check_email_query_run) > 0) {
            $_SESSION['status'] =  "Email Id already Exist ";
            header("Location:register.php");
        }else {
            // Insert user / register user data
            $query = "INSERT INTO `users`(`username`, `email`, `password`, `token`) VALUES ('$user_userName','$user_userEmail','$user_userPassword','$token')";
            $query_run = mysqli_query($con , $query);

            if($query_run) {
                $user->sendemail_verify("$user_userName" , "$user_userEmail" , "$token");
                $_SESSION['status'] =  "Registration Successfull. Please verify your email address.";
                header("Location:register.php");
            }else {
                $_SESSION['status'] =  "Registration Failed";
                header("Location:register.php");
            }
        }

    }