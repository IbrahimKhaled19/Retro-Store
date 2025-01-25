<?php 
  session_start();
  if(isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "You are already Logged In";
    header("Location:../../../Product/index.php");
    exit(0);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Change Password</title>
    <!-- main stylesheet -->
    <link rel="stylesheet" href="../../css/Auth/password-reset.css">
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
        <?php
            unset($_SESSION['status']);
          }
        ?>
      </nav>
    </header>
    <section class="f-lg">
      <form action="password-change-code.php" method="POST">
        <input type="hidden" name = "password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>">
        <div class="i-email">
          <div><i class="fa-solid fa-envelope"></i></div>
          <div>
            <input
              type="email"
              name="email"
              placeholder="Enter your email please..."
              id="email"
              value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>"
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
        <div class="i-confirm-password">
          <div><i class="fa-solid fa-lock"></i></div>
          <div>
            <input
              type="password"
              name="c-password"
              placeholder="Confirm your password please..."
              id="c-password"
            />
          </div>
        </div>
        <span>* Please Fill all the fields and validate data </span>
        <div class="f-submit">
          <input type="submit" name="password-update" value="Update Password" id="submit" />
        </div>
     </form>
    </section>
    <script src="../../js/Auth/resetv2.js"></script>
  </body>
</html>
