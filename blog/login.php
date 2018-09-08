<?php
session_start();

include_once ('includes/config.php');
include_once ('includes/db.php');

if (isset($_SESSION['userSession']) != '') {
 header("Location: admin/index.php");
 exit;
}

if (isset($_POST['login'])) {

 $email = strip_tags($_POST['email']);
 $password = strip_tags($_POST['password']);

 $email = $db->real_escape_string($email);
 $password = $db->real_escape_string($password);

 $query = $db->query("SELECT id, email, password FROM users WHERE email='$email'");
 $row = $query->fetch_array();
 
 $count = $query->num_rows;
 
 if (password_verify($password, $row['password']) && $count==1) {
  $_SESSION['userSession'] = $row['id'];
  header("Location: admin/index.php");
 }
 else{
  ?>
<script>alert("Incorrect Email or Password");</script>
   <?php
 }
 $db->close();
}
?>
<html>
 <head>
  <link rel="stylesheet" type="text/css" href="css/style2.css">

 </head>
 <body>
  <div class="form-wrapper">
   <a href="index.php"><img src="http://placehold.it/150x80"></a>
   <form action="#" method="post">
    <h3>Login here</h3>

    <div class="form-item">
     <input type="email" name="email" required="required" placeholder="Email" autofocus required></input>
    </div>

    <div class="form-item">
     <input type="password" name="password" required="required" placeholder="Password" required></input>
    </div>

    <div class="button-panel">
     <input type="submit" class="button" title="Log In" name="login" value="Login"></input>
    </div>
   </form>
   <div class="reminder">
    <p><a href="register.php">Not a member?  Sign up now</a></p>
    <p><a href="#">Forgot password?</a></p>
   </div>

  </div>

 </body>
</html>