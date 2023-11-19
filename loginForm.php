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
      </div>
      <div class="input-box">
        <input type="password" name="pass" placeholder="Password" required>
      </div>
      <div class="input-box button">
        <input type="Submit" name="submit" value="Log in">
      </div>
    </form>
  </div>
</body>
</html>