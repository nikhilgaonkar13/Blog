<?php
include './header.php';
session_start();

include '../includes/config.php';
include '../includes/db.php';

function get_total_comments($p_id,$db) {
 $c_query = mysqli_query($db, "select count(id) as total from comments where p_id = '$p_id'");
 $total = mysqli_fetch_assoc($c_query);
 return $total['total'];
}

if (isset($_SESSION['userSession'])) {

 $u_id = $_SESSION['userSession'];
 ?>

 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
  <div class="row">
   <ol class="breadcrumb">
    <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
    <li class="active">Comments</li>
   </ol>
  </div><!--/.row-->

  <div class="row">
   <div class="col-lg-12">
    <h1 class="page-header">Comments</h1>
   </div>
  </div><!--/.row-->

  <div class="row">
   <div class="col-lg-12">
    <div class="panel panel-default">
     <div class="panel-heading">All posts</div>
     <div class="panel-body">
      <?php
      $p_query = mysqli_query($db, "select id , title from posts where u_id = '$u_id'");
      $i = 0;
      while ($post = mysqli_fetch_assoc($p_query)) {
       $response[$i]['id'] = $post['id'];
       $response[$i]['title'] = $post['title'];
       $response[$i]['total'] = get_total_comments($post['id'],$db);
       $data['posts'][$i] = $response[$i];
       $i = $i + 1;
      }
      $json_string = json_encode($data['posts']);
      //echo $json_string;
      $file = 'posts_data.json';
      file_put_contents($file, $json_string);
      ?>
      <table data-toggle="table" data-url="posts_data.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
       <thead>
        <tr>
         <th data-field="state" data-checkbox="true" >Item ID</th>
         <th data-field="id" data-sortable="true">Sr No</th>
         <th data-field="title"  data-sortable="true">Title</th>
         <th data-field="total" data-sortable="true">Total Comments</th>
        </tr>
       </thead>
      </table>
     </div>
    </div>
   </div>
  </div><!--/.row-->	

 </div>	<!--/.main-->

 <script src="js/jquery-1.11.1.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap-table.js"></script>
 </body>

 </html>
 <?php
} else {
 header("Location: ../login.php");
}?>