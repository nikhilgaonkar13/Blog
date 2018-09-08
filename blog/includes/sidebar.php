<?php
include './includes/config.php';
include './includes/db.php';

$query = "select * from posts where u_id = '$u_id'";

$all_posts = $db->query($query);
?>
<!-- Sidebar -->
<div id="sidebar" class="4u">
 <section>
<!--  <div class="row"> 
   <form class="form-inline" method="get" action="results.php">
    <div class="form-group">
     <input type="text" class="form-control" name="search" id="search" placeholder=" Search for posts here...">
    </div>
   </form>
  </div>-->
  <header>
   <h2>Other Posts by Author</h2>
  </header>
  <ul class="style">
   <?php
   if ($all_posts->num_rows > 0) {
     while($s_post = $all_posts->fetch_assoc()){
    ?>
    <li>
     <h3><?php echo $s_post['title'];?></h3>
     <p class="posted"><?php echo $s_post['date'];?></p>
     <img src="images/pic04.jpg" alt="" />
     <p class="text"><?php echo substr($s_post['body'],0,150).'.....';?></p>
     <a href="blog.php?posts=<?php echo $s_post['id'];?>" class=""> <b>Read more</b></a>
    </li>
     <?php } } ?>

  </ul>
 </section>
</div>