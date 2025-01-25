<?php session_start()?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <!-- main stylesheet -->
    <link rel="stylesheet" href="../../css/Auth/register.css" />
    <!-- reset page -->
    <link rel="stylesheet" href="../../css/Auth/normalize.css" />
    <!-- font-icons -->
    <link rel="stylesheet" href="../../css/Auth/all.min.css" />
  </head>
  <body>
    <header>
      <nav>
        <h1>Retro Store</h1>
        <h5 style="color:white; font-size:13px; text-align:center;">
          <?php 
            if(isset($_SESSION["status"])) {
              echo $_SESSION['status'];
              unset($_SESSION['status']);
            }
          ?>
        </h5>
      </nav>
    </header>
    <section class="f-lg">
      <form action="code.php" method="POST">
        <div class="i-user">
          <div><i class="fa-solid fa-user"></i></div>
          <div>
            <input
              type="text"
              name="user"
              placeholder="Enter your username please..."
              id="user"
            />
          </div>
        </div>
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
        <span>* please validate your data entry </span>
        <div class="f-submit">
          <input type="submit" name="register_btn" id="submit" value="signup" />
        </div>
        <a href="login.php">You already have an account</a>
      </form>
    </section>
    <script src="../../js/Auth/register.js"></script>
  </body>
</html>
