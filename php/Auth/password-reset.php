<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset passwrod</title>
    <!-- main style -->
    <link rel="stylesheet" href="../../css/Auth/reset.css">
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
      <form action="password-reset-code.php" method="POST">
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
        <span>* Please Fill The email field. ! </span>
        <div class="f-submit">
          <input type="submit" name="reset_btn" value="send reset link" id="submit" />
        </div>
      </form>
    </section>
    <script src="../../js/Auth/reset.js"></script>
  </body>
</html>
