<?php //

include('./includes/config.php');
include './includes/db.php';

if ($_POST) {
 $username = mysql_real_escape_string($_POST['username']);
 $email = mysql_real_escape_string($_POST['email']);
 $password = mysql_real_escape_string($_POST['password']);
 $phone = mysql_real_escape_string($_POST['phone']);
 $brief = mysql_real_escape_string($_POST['brief']);

 $count = 0;

 if ($count > 0) {
  ?>
  <script>
   alert("This username is already in use. Please choose another");
  </script>
  <?php

 } else {
  $query = "insert into users values ('','$username','$email','$password','$brief','$phone')";
  mysqli_query($db, $query);
  ?>
  <script>
   alert("Regsitration Successful. Start Blogging!");
  </script>
  <?php

 }
}
?>