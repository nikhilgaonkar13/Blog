<?php
include './includes/config.php';
include './includes/db.php';

$u_id = NULL;
$p_id = NULL;
if (isset($_GET['posts'])) {

 $id = mysqli_real_escape_string($db, $_GET['posts']);
 $p_id = $id;
 $query = "Select * from posts where id = '$id'";
 $comment = "Select * from comments where p_id = '$id'";
}
$posts = $db->query($query);
$comments = $db->query($comment);

if (isset($_POST['follow_auth'])) {

 $u_id = (int) htmlspecialchars($_POST['u_id']);

 $username = trim($_POST['name']);
 $username = strip_tags($username);
 $username = htmlspecialchars($username);

 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $rate = trim($_POST['rating']);
 $rate = strip_tags($rate);
 $rate = htmlspecialchars($rate);

 $check_email = $db->query("select * from followers where email_from = '$email'");
 $count = $check_email->num_rows;
 if ($count == 0) {
  $f_query = "INSERT INTO `followers` VALUES ('','$u_id','$email','$username',CURDATE())";

  if ($db->query($f_query)) {
   //=============Rating=================
   $r_query = "select id from followers where email_from = '$email'";
   $r_res = $db->query($r_query);
   $foll_id = $r_res->fetch_assoc();
   $f_id = $foll_id['id'];
   $rating = "INSERT INTO `rating` VALUES ('','$f_id','$u_id','$rate',CURDATE())";
   if ($db->query($rating)) {
    ?>
    <script>alert("You started follwoing this Author!");</script>
    <?php
   }
  }
 } else {
  ?>
  <script>alert("You are Already following this Author.");</script>
  <?php
 }
}

if (isset($_POST['post_comment'])) {
 $post_id = (int) $_POST['post_id'];

 $c_name = trim($_POST['name']);
 $c_name = strip_tags($c_name);
 $c_name = htmlspecialchars($c_name);

 $c_email = trim($_POST['email']);
 $c_email = strip_tags($c_email);
 $c_email = htmlspecialchars($c_email);

 $c_comment = trim($_POST['comment']);
 $c_comment = strip_tags($c_comment);
 $c_comment = htmlspecialchars($c_comment);


 if ($c_name != "" && $c_email != "" && $c_comment != "") {
  $c_query = "INSERT INTO `comments`(`id`, `p_id`, `name`, `email`, `comment`, `date`) VALUES ('','$post_id','$c_name','$c_email','$c_comment',CURDATE())";

  if ($db->query($c_query)) {
   ?>
   <script>alert("Your comment successfully posted!");</script>
   <?php
  }
 } else {
  ?>
  <script>alert("Please fill in all fields correctly!");</script>
  <?php
 }
}
?>
<!DOCTYPE HTML>
<html>
 <head>
  <title>Iridium by TEMPLATED</title>
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
  <style>
   #comment_form input, #comment_form textarea {
    border: 1px solid rgba(0,0,0,0.1);
    padding: 8px 10px;

    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;

    outline: 0;
   }

   #comment_form textarea {
    width: 350px;
   }

   #comment_form input[type="submit"] {
    cursor: pointer;
    background: -webkit-linear-gradient(top, #efefef, #ddd);
    background: -moz-linear-gradient(top, #efefef, #ddd);
    background: -ms-linear-gradient(top, #efefef, #ddd);
    background: -o-linear-gradient(top, #efefef, #ddd);
    background: linear-gradient(top, #efefef, #ddd);
    color: #333;
    text-shadow: 0px 1px 1px rgba(255,255,255,1);
    border: 1px solid #ccc;
   }

   #comment_form input[type="submit"]:hover {
    background: -webkit-linear-gradient(top, #eee, #ccc);
    background: -moz-linear-gradient(top, #eee, #ccc);
    background: -ms-linear-gradient(top, #eee, #ccc);
    background: -o-linear-gradient(top, #eee, #ccc);
    background: linear-gradient(top, #eee, #ccc);
    border: 1px solid #bbb;
   }

   #comment_form input[type="submit"]:active {
    background: -webkit-linear-gradient(top, #ddd, #aaa);
    background: -moz-linear-gradient(top, #ddd, #aaa);
    background: -ms-linear-gradient(top, #ddd, #aaa);
    background: -o-linear-gradient(top, #ddd, #aaa);
    background: linear-gradient(top, #ddd, #aaa);	
    border: 1px solid #999;
   }

   #comment_form div {
    margin-bottom: 8px;
   }
  </style>
  <link href="css/rating.css" rel="stylesheet" type="text/css"/>
 </head>
 <body>

  <?php include './includes/header.php'; ?>

  <!-- Main -->
  <div id="main">
   <div class="container">
    <div class="row"> 

     <!-- Content -->
     <div id="content" class="8u skel-cell-important">
      <section>
       <?php
       if ($posts->num_rows > 0) {
        while ($row = $posts->fetch_assoc()) {
         $u_id = $row['u_id'];
         ?>

         <header>
          <h2><?php echo $row['title']; ?></h2>
         </header>
         <a href="#" class="image full"><img src="images/pic07.jpg" alt="" /></a>
         <p><?php echo $row['body']; ?></p><br/>
         <p style="float:right;padding:10px;margin-right:50px;color:orange;"> <i>posted at -</i> <?php echo date("j F Y", strtotime($row['date'])); ?></p>
         <br/><br/>

         <?php
        }
       }
       $user = mysqli_query($db, "select * from users where id = '$u_id'");
       $user = $user->fetch_assoc();
       ?>
       <blockquote><h2 style="color:gold;font-size:1.5em;"> - <?php echo $user['name']; ?><br/><?php echo $row['date']; ?></h2></blockquote><br/>
      </section>

      <form method="post" style="padding:10px;">
       <h3>Follow AND Rate this Author</h3><hr>
       <input type="text" name="name" placeholder="Name" required style="width:50%;padding:2px;"><br/>
       <div style="height:10px;"></div>
       <input type="email" name="email"  placeholder="Email" required style="width:50%;padding:2px;"><br/>
       <div style="height:10px;"></div>
       <h2>Rate The Author of This POST</h2>
       <fieldset id='demo2' class="rating">
        <input class="stars" type="radio" id="star5" name="rating" value="5" />
        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
        <input class="stars" type="radio" id="star4half" name="rating" value="4.5" />
        <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
        <input class="stars" type="radio" id="star4" name="rating" value="4" />
        <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
        <input class="stars" type="radio" id="star3half" name="rating" value="3.5" />
        <label class="half" for="star3half" title="Meh - 3.5 stars"></label>
        <input class="stars" type="radio" id="star3" name="rating" value="3" />
        <label class = "full" for="star3" title="Meh - 3 stars"></label>
        <input class="stars" type="radio" id="star2half" name="rating" value="2.5" />
        <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
        <input class="stars" type="radio" id="star2" name="rating" value="2" />
        <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
        <input class="stars" type="radio" id="star1half" name="rating" value="1.5" />
        <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
        <input class="stars" type="radio" id="star1" name="rating" value="1" />
        <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
        <input class="stars" type="radio" id="starhalf" name="rating" value="0.5" />
        <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
       </fieldset><br/><br/>
       <input type="hidden" name='u_id' value="<?php echo $user['id']; ?>">
       <button type="submit" name="follow_auth" style="color:White;font-size:16px;padding:7px 10px;background:gold;border:none;">Follow</button>
      </form>
     </div>
     <?php include './includes/sidebar.php'; ?>
    </div>
    <div class="row">
     <div class="8u skel-cell-important">
      <form method="post" id="comment_form">
       <br/><br/>
       <h1 style="font-size:25px">Post a Comment</h1><br/>
       <input type="text" name="name" placeholder="Name" required style="width:100%;">
       <br/><br/>
       <input type="email" name="email"  placeholder="Email" required style="width:100%;">
       <br/><br/>
       <textarea name="comment" cols="60" rows="5" style="width:100%;" placeholder="Comment here...." required></textarea>
       <br/><br/><input type="hidden" name='post_id' value="<?php echo $p_id; ?>">
       <button type="submit" name="post_comment" style="width:100%; height:50px; color:White;background:gold;border:none;">Post Comment</button>
      </form><br/><br/>
      <blockquote><h2>Comments</h2></blockquote><br/>
      <div class="comment-area">
       <?php
       if ($comments->num_rows > 0) {
        while ($c_row = $comments->fetch_assoc()) {
         ?>
         <div class="comment" style="border: 1px solid lightblue; padding : 10px; background-color: #EFF9FB;">
          <div class="comment-head">
           <h3><b style="padding : 10px 0; font-size:18px; color:darkblue;"><?php echo $c_row['name']; ?></b></h3>
          </div>
          <p style="color:grey; font-weight:100;"><?php echo $c_row['comment']; ?></p>
         </div>
         <br/>
         <?php
        }
       }
       ?>
       <br/>
      </div>
     </div>
    </div>
   </div>
  </div>
  <div id="copyright">
   <div class="container">
    <a href="index.php"><img src="http://placehold.it/150x80"></a>
   </div>
  </div>
 </body>
</html>