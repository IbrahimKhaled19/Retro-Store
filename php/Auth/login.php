<?php 
  session_start();
  if(isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "You are already Logged In";
    header("Location: http://localhost/web/Sources/php/Product/index.php");
    exit(0);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>login</title>
    <!-- main stylesheet -->
    <link rel="stylesheet" href="../../css/Auth/login.css">
    <!-- reset page -->
    <link rel="stylesheet" href="../../css/Auth/normalize.css" />
    <!-- font-icons -->
    <link rel="stylesheet" href="../../css/Auth/all.min.css" />
  </head>
  <body>
    <header>
      <nav>
        <h1>Retro Store</h1>
        <?php
          if(isset($_SESSION['status'])) {
            ?>
        <h5 style="color: white; font-size: 13px; text-align: center">
          <?= $_SESSION['status']?>
        </h5>
        <h5><?= $_SESSION['user_id']?></h5>
        <?php
            unset($_SESSION['status']);
          }
        ?>
      </nav>
    </header>
    <section class="f-lg">
      <form action="logincode.php" method="POST">
        <div class="i-email">
          <div><i class="fa-solid fa-envelope"></i></div>
          <div>
            <input
              type="email"
              name="email"
              placeholder="Enter your email please..."
              id="email"
            />
          </div>
        </div>
        <div class="i-password">
          <div><i class="fa-solid fa-lock"></i></div>
          <div>
            <input
              type="password"
              name="password"
              placeholder="Enter your password please..."
              id="password"
            />
          </div>
        </div>
        <span>* There is something wrong in the password or email </span>
        <div class="f-submit">
          <input type="submit" name="login_btn" value="login" id="submit" />
        </div>
        <a href="register.php" style="font-size:13px;">You don't have an account ?</a>
        <a href="password-reset.php" style="font-size:13px;">Forgot Your Password ?</a>
      </form>
    </section>
    <script src="../../js/Auth/login.js"></script>
  </body>
</html>
