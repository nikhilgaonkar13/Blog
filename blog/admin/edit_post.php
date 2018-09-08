<?php
include './header.php';
session_start();

include '../includes/config.php';
include '../includes/db.php';

function format_date($date) {
 $xplod = explode("/", $date);
 echo $xplod;
 $new_date = "$xplod[0]-$xplod[2]-$xplod[1]";
 return $new_date;
}

if (isset($_SESSION['userSession'])) {
 
 if (isset($_POST['post'])) {

  $id = (int)($_POST['id']);
  
  $title = trim($_POST['title']);
  $title = strip_tags($title);
  $title = htmlspecialchars($title);

  $date = trim($_POST['date']);
  $date = strip_tags($date);
  $date = htmlspecialchars($date);
  $date = format_date($date);

  $content = trim($_POST['content']);
  $content = strip_tags($content);
  $content = htmlspecialchars($content);

  $tags = trim($_POST['tags']);
  $tags = strip_tags($tags);
  $tags = htmlspecialchars($tags);

  if ($title != "" && $date != "" && $content != "" && $tags != "") {
   $query = "UPDATE `posts` SET `title`='$title',`body`='$content',`date`='$date',`tags`='$tags' WHERE `id`='$id'";
   $res = mysqli_query($db, $query);
   if ($res) {
    header("Location: posts.php");
   }
  }
 }
 //==============================================================================
 
 $u_id = $_SESSION['userSession'];

 $p_id = (int) $_GET['post'];

 $query = "select * from posts where id = '$p_id'";

 $query = mysqli_query($db, $query);

 $post = mysqli_fetch_assoc($query);
 ?>

 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
  <div class="row">
   <ol class="breadcrumb">
    <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
    <li class="active">Icons</li>
   </ol>
  </div><!--/.row-->

  <div class="row">
   <div class="col-lg-8">
    <h1 class="page-header">Edit Post</h1>
   </div>
   <div class="col-lg-4"><br>
    <a href="posts.php" class="btn btn-lg btn-info pull-right"><span class="glyphicon glyphicon-backward"></span> Back</a>
   </div>
  </div><!--/.row-->

  <div class="row">
   <div class="col-lg-12">
    <div class="panel panel-default">
     <div class="panel-body">
      <form method="post">
       <div class="form-group">
        <label for="exampleInputEmail1">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post['title']; ?>" id="exampleInputEmail1" placeholder="Title for the Post" required>
       </div>
       <div class="form-group">
        <label for="exampleInputPassword1">Post Date</label>
        <input type="text" class="form-control datepicker" name="date" value="<?php echo $post['date']; ?>" id="exampleInputPassword1" placeholder="date" required>
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Post Content</label>
        <textarea type="text" class="form-control" name="content" id="exampleInputEmail1" placeholder="Content of the Post" rows="10" cols="100" required><?php echo $post['body']; ?></textarea>
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Tags</label>
        <input type="text" class="form-control" name="tags" value="<?php echo $post['tags']; ?>" id="exampleInputEmail1" placeholder="Keywords for the post" required>
       </div><input type="hidden" name="id" value="<?php echo $p_id?>">
       <button type="submit" name="post" class="btn btn-default btn-success">Save</button>
      </form>
     </div>
    </div>
   </div>
  </div><!--/.row-->	



 </div><!--/.main-->

 <script src="js/jquery-1.11.1.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap-datepicker.js"></script>
 <script src="js/bootstrap-table.js"></script>
 <script>
  !function ($) {
   $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
    $(this).find('em:first').toggleClass("glyphicon-minus");
   });
   $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
  }(window.jQuery);

  $(window).on('resize', function () {
   if ($(window).width() > 768)
    $('#sidebar-collapse').collapse('show')
  })
  $(window).on('resize', function () {
   if ($(window).width() <= 767)
    $('#sidebar-collapse').collapse('hide')
  })
 </script>	

 <script>
  $(function () {
   $('.datepicker').datepicker({
    format: 'yyyy/dd/mm'
   });
  });
 </script>

 </body>

 </html>
 <?php
} else {
 header("Location: ../login.php");
}
?>