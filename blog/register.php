<?php
ob_start();
session_start();

if (isset($_SESSION['userSession']) != "") {
 header("Location:login.php");
}

include_once('./includes/config.php');
include_once('./includes/db.php');

if (isset($_POST['register'])) {

 $username = trim($_POST['username']);
 $username = strip_tags($username);
 $username = htmlspecialchars($username);

 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $password = trim($_POST['password']);
 $password = strip_tags($password);
 $password = htmlspecialchars($password);

 $phone = trim($_POST['phone']);
 $phone = strip_tags($phone);
 $phone = htmlspecialchars($phone);

 $brief = trim($_POST['brief']);
 $brief = strip_tags($brief);
 $brief = htmlspecialchars($brief);

// //username validation
// if (empty($username)) {
//  $error = true;
//  $name_error = "Please enter you full name";
// } else if (strlen($username < 3)) {
//  $error = true;
//  $name_error = "Name should be more than 3 characters";
// } else if (!preg_match("/^[a-zA-Z ]+$/", $username)) {
//  $error = true;
//  $name_error = "Name should contain only alphabets and blank spaces";
// }
// //email validation
// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//  $error = true;
//  $emailError = "Please enter valid email address.";
// } else {
//  // check email exist or not
//  $query = "SELECT email FROM users WHERE email='$email'";
//  $result = mysqli_query($db,$query);
//  $count = mysqli_num_rows($result);
//  if ($count != 0) {
//   $error = true;
//   $emailError = "Provided Email is already in use.";
//  }
// }
// // password validation
// if (empty($password)) {
//  $error = true;
//  $passError = "Please enter password.";
// } else if (strlen($password) < 6) {
//  $error = true;
//  $passError = "Password must have atleast 6 characters.";
// }
//
// // password encrypt using SHA256();
// $password = hash('sha256', $password);
//
// //Phone validation
// if (empty($phone)) {
//  $error = true;
//  $phone_error = "Please enter Phone Number";
// } else if (strlen($phone < 9)) {
//  $error = true;
//  $phone_error = "Phone Number should be more than 9 characters";
// } else if (!preg_match("/^[0-9]+$/", $phone)) {
//  $error = true;
//  $phone_error = "Should contain only numbers";
// }
//
// //brief validation
// if (empty($brief)) {
//  $error = true;
//  $brief_error = "Please enter you full name";
// } else if (strlen($brief < 10)) {
//  $error = true;
//  $brief_error = "About you should be more than 3 characters";
// } else if (!preg_match("/^[a-zA-Z ]+$/", $brief)) {
//  $error = true;
//  $brief_error = "About yourself should contain only alphabets and blank spaces";
// }

 $password = password_hash($password, PASSWORD_DEFAULT);
 $check_email = $db->query("select email from users where email = '$email'");
 $count = $check_email->num_rows;

 if ($count == 0) {
  $query = "insert into users values ('','$username','$email','$password','$brief','$phone','')";

  if ($db->query($query)) {
   ?>
   <script>alert("Regsitration Successful!");</script>
   <?php
   header("Location: login.php");
  } else {
   ?>
   <script>alert("Unuccessful!");</script>
   <?php
  }
 } else {
  ?>
  <script>alert("Try another Email");</script>
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
  <div class="form-wrapper-2">
   <a href="index.php"><img src="http://placehold.it/150x80"></a>
   <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on">
    <h3>Sign Up!</h3>    
    <div class="form-item">
     <input type="text" name="username" required="required" placeholder="Username" autofocus required pattern="^[A-Za-z]+">
    </div>
    <div class="form-item">
     <input type="email" name="email" required="required" placeholder="Email id" autofocus required>
    </div>
    <div class="form-item">
     <input type="password" name="password" required="required" placeholder="Password" required>
    </div>
    <div class="form-item">
     <input type="text" name="phone" required="required" placeholder="Phone No." autofocus required>
    </div>
    <div class="form-item">
     <textarea type="text" name="brief" required="required" placeholder="About yourself" autofocus required rows="5" cols='82' resize='false'></textarea>
    </div>
    <div class="button-panel">
     <input type="submit" class="button" title="Register" name="register" value="Register"></input>
    </div>
   </form>
   <div class="reminder">
    <p><a href="login.php">Already Registered?</a></p>
   </div>
  </div>
  <script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
 </body>
</html>
<?php ob_end_flush(); ?>