<?php
include './includes/config.php';
include './includes/db.php';

$query = "Select * from posts";

$posts = $db->query($query);
?>
<!DOCTYPE HTML>
<html>
 <head>
  <title>Blogger</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link href='http://fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>
  <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="js/skel.min.js"></script>
  <script src="js/skel-panels.min.js"></script>
  <script src="js/init.js"></script>
  <noscript>
  <link rel="stylesheet" href="css/skel-noscript.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/style-desktop.css" />
  </noscript>
  <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
  <!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
 </head>
 <body class="homepage">
  <?php include './includes/header.php'; ?>
  <!-- Footer -->
  <div id="featured">
   <div class="container">

    <div class="row">
     <?php
     if ($posts->num_rows > 0) {

      while ($row = $posts->fetch_assoc()) {     
      ?>
      <div class="4u">
       <h2><?php echo $row['title']?></h2>
       <a href="#" class="image full"><img src="images/pic01.jpg" alt="" /></a>
       <p><?php echo substr($row['body'],0,400)."...";?></p>
       <p><a href="blog.php?posts=<?php echo $row['id'];?>" class="button">More Details</a></p>
      </div>
      <?php } } ?>
    </div>
   </div>
  </div>




  <!-- Copyright -->
  <div id="copyright">
   <div class="container">
    <a href="index.php"><img src="http://placehold.it/150x80"></a>
   </div>
  </div>

 </body>
</html>