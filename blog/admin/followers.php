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
    <li class="active">Followers</li>
   </ol>
  </div><!--/.row-->

  <div class="row">
   <div class="col-lg-8">
    <h1 class="page-header">Followers</h1>
   </div>
   <div class="col-lg-4"><br>
    <a href="#" class="btn btn-lg btn-block btn-info pull-right"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Notify Followers</a>
   </div>
  </div><!--/.row-->

  <div class="row">
   <div class="col-lg-12">
    <div class="panel panel-default">
     <div class="panel-heading">List of Followers</div>
     <div class="panel-body">
      <?php
      $query = "Select * from followers where u_id = '$u_id'";
      $query = mysqli_query($db, $query);
      $i = 0;
      while ($foll = mysqli_fetch_assoc($query)) {
       $response[$i]['id'] = $foll['id'];
       $response[$i]['name'] = $foll['name'];
       $response[$i]['email'] = $foll['email_from'];
       $data['followers'][$i] = $response[$i];
       $i = $i + 1;
      }
      $json_string = json_encode($data['followers']);
      // echo $json_string;
      $file = 'followers.json';
      file_put_contents($file, $json_string);
      ?>
      <table data-toggle="table" data-url="followers.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="id" data-sort-order="asc">
       <thead>
        <tr>
         <th data-field="state" data-checkbox="true" >Item ID</th>
         <th data-field="id" data-sortable="true">ID</th>
         <th data-field="name"  data-sortable="true">Name</th>
         <th data-field="email" data-sortable="true">Email</th>
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