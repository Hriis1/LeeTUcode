<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Registration form </title>
  <link rel="stylesheet" href="rec/css/signupStyle.css">
  <style>
    .captcha_refersh {
      width: 50px;
      height: 20px;
      background-color: blue;
      margin-left: 10px;
    }

    #capthaError {
      margin-top: 5px;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <h2>Registration</h2>
    <form id="signUpForm" action="include/signupUser.php" method="post">
      <div class="input-box">
        <input type="text" name="username" placeholder="Username" required>
      </div>
      <div class="input-box">
        <input type="text" name="email" placeholder="Email" required>
      </div>
      <div class="input-box">
        <input type="password" name="pass" placeholder="Password" required>
      </div>
      <div class="">
        <label for="accountType">Account Type:</label>
        <select id="accountType" name="accountType" required>
          <option value="student">Student</option>
          <option value="teacher">Teacher</option>
        </select>
      </div>
      <div id="submitBox" class="input-box button">
        <input type="Submit" name="submit" value="Register Now">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="loginForm.php">Login now</a></h3>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="js/captcha.js"></script>
</body>

</html>