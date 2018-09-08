<?php
include './header.php';
session_start();

include '../includes/config.php';
include '../includes/db.php';

if (isset($_SESSION['userSession'])) {

 if (isset($_POST['post'])) {

  $id = (int) $_POST['id'];

  $username = trim($_POST['name']);
  $username = strip_tags($username);
  $username = htmlspecialchars($username);

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $r_email = trim($_POST['r_email']);
  $r_email = strip_tags($r_email);
  $$r_email = htmlspecialchars($r_email);

  $password = trim($_POST['password']);
  $password = strip_tags($password);
  $password = htmlspecialchars($password);

  $password = password_hash($password, PASSWORD_DEFAULT);

  $phone = trim($_POST['phone']);
  $phone = strip_tags($phone);
  $phone = htmlspecialchars($phone);

  $brief = trim($_POST['brief']);
  $brief = strip_tags($brief);
  $brief = htmlspecialchars($brief);

  if ($username != "" && $email != "" && $r_email != "" && $password != "" && $phone != "" && $brief != "") {
   $query = "UPDATE `users` SET `name` = '$username', `email` = '$email', `password` = '$password', `brief` = '$brief',`phone` = '$phone', `rec_email` = '$r_email' where `id` = '$id'";
   $res = mysqli_query($db, $query);
   if ($res) {
    ?>
    <script>alert("Profile Updated Successfully!");</script>
    <?php
    header("Location: index.php");
   } else {
    ?>
    <script>alert("Unuccessful!");</script>
    <?php
   }
  } else {
    ?>
    <script>alert("Please fill in all the fields");</script>
    <?php
  }
 }
//==============================================================================
 $u_id = $_SESSION['userSession'];

 $query = "select * from users where id = '$u_id'";

 $query = mysqli_query($db, $query);

 $user = mysqli_fetch_assoc($query);
 ?>

 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
  <div class="row">
   <ol class="breadcrumb">
    <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
    <li class="active">Profile</li>
   </ol>
  </div><!--/.row-->

  <div class="row">
   <div class="col-lg-12">
    <h1 class="page-header">Profile</h1>
   </div>
  </div><!--/.row-->

  <div class="row">
   <div class="col-lg-12">
    <div class="panel panel-default">
     <div class="panel-body">
      <form method="post">
       <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" placeholder="Name" required>
       </div>
       <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" placeholder="Email ID" required>
       </div>
       <div class="form-group">
        <label for="r_email">Recovery Email</label>
        <input type="email" class="form-control" name="r_email" value="<?php echo $user['rec_email']; ?>" placeholder="Email ID" required>
       </div>
       <div class="form-group">
        <label for="phone">Mobile Number</label>
        <input type="text" class="form-control" name="phone" value="<?php echo $user['phone']; ?>" placeholder="Phone number...." required>
       </div>
       <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" value="<?php echo $user['password']; ?>" placeholder="Password here..." required>
       </div>
       <div class="form-group">
        <label for="brief">ABout Yourself</label>
        <textarea type="text" class="form-control" name="brief" placeholder="about yourself..." required><?php echo $user['brief']; ?></textarea>
       </div>
       <input type="hidden" name="id" value="<?php echo $u_id ?>">
       <button type="submit" name="post" class="btn btn-default btn-success">Update</button>
      </form>
     </div>
    </div>
   </div>
  </div><!--/.row-->	

 </div>	<!--/.main-->

 <script src="js/jquery-1.11.1.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 </body>

 </html>
 <?php
} else {
 header("Location: ../login.php");
}?>