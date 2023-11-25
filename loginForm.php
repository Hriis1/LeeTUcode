<?php include_once "include/sessionConfig.php"; ?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Log in form </title>
  <link rel="stylesheet" href="rec/css/signupStyle.css">
</head>

<body>
  <div class="wrapper">
    <h2>Log in</h2>
    <form action="include/loginUser.php" method="post">
      <div class="input-box">
        <input type="text" name="username" placeholder="Username" required>
        <p class="username-error error_text"></p>
      </div>
      <div class="input-box">
        <input type="password" name="pass" placeholder="Password" required>
        <p class="password-error error_text"></p>
      </div>
      <div class="input-box button">
        <input type="Submit" name="submit" value="Log in">
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script>
    $(document).ready(function () {
      
      <?php
      if (isset($_SESSION["errors_login"])) { ?>
        <?php
        if (isset($_SESSION["errors_login"]["empty_input"])) { ?>
          $(".password-error").text("<?php echo $_SESSION["errors_login"]["empty_input"]; ?>");
          <?php unset($_SESSION["errors_login"]["empty_input"]); ?>
        <?php } ?>
        <?php
        if (isset($_SESSION["errors_login"]["login_incorrect"])) { ?>
          $(".username-error").text("<?php echo $_SESSION["errors_login"]["login_incorrect"]; ?>");
          <?php unset($_SESSION["errors_login"]["login_incorrect"]); ?>
        <?php } ?>
        <?php
        if (isset($_SESSION["errors_login"]["incorrect_password"])) { ?>
          $(".password-error").text("<?php echo $_SESSION["errors_login"]["incorrect_password"]; ?>");
          <?php unset($_SESSION["errors_login"]["incorrect_password"]); ?>
        <?php } ?>
      <?php } ?>
    });
  </script>
</body>

</html>