<?php
include './header.php';
session_start();

include '../includes/config.php';
include '../includes/db.php';

if (isset($_SESSION['userSession'])) {
 
 $u_id = $_SESSION['userSession'];
 ?>

 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
  <div class="row">
   <ol class="breadcrumb">
    <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
    <li class="active">Posts</li>
   </ol>
  </div><!--/.row-->

  <div class="row">
   <div class="col-lg-8">
    <h1 class="page-header">Posts</h1>
   </div>
   <div class="col-lg-4"><br>
    <a href="add_post.php" class="btn btn-lg btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> Add Post</a>
   </div>
  </div><!--/.row-->

  <div class="row">
   <div class="col-lg-12">
    <div class="panel panel-default">
     <div class="panel-heading">All posts</div>
     <div class="panel-body">
      <?php 
       $query = "Select * from posts where u_id = '$u_id'";
       $query = mysqli_query($db,$query);
       $i=0;
       while ($post = mysqli_fetch_assoc($query)){
        $response[$i]['id'] = $post['id'];
        $response[$i]['title'] = '<a href="posts.php?post='.$post['id'].'">'.$post['title'].'</a>';
        $response[$i]['date'] = $post['date'];
        $response[$i]['action'] = '<a href="edit_post.php?post='.$post['id'].'"><span class="glyphicon glyphicon-edit"></span></a>'.'&nbsp;&nbsp;&nbsp;'.'<a href="delete_post.php?post='.$post['id'].'"><span class="glyphicon glyphicon-remove"></span></a>';
        $data['posts'][$i] = $response[$i];
        $i = $i + 1;
       }
       $json_string = json_encode($data['posts']);
       //echo $json_string;
       $file = 'posts.json';
       file_put_contents($file, $json_string);
       ?>
      <table data-toggle="table" data-url="posts.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
       <thead>
        <tr>
         <th data-field="state" data-checkbox="true" >Item ID</th>
         <th data-field="id" data-sortable="true">Sr No</th>
         <th data-field="title"  data-sortable="true">Title</th>
         <th data-field="date" data-sortable="true">Date</th>
         <th data-field="action">Actions</th>
        </tr>
       </thead>
      </table>
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
 </body>

 </html>
 <?php
} else {
 header("Location: ../login.php");
}?>