<?php
include './header.php';
session_start();

include '../includes/config.php';
include '../includes/db.php';

$u_id = NULL;

function total_followers($u_id, $db) {
 $query = mysqli_query($db, "select count(id) as total from followers where u_id = '$u_id'");
 $total = mysqli_fetch_assoc($query);
 return $total['total'];
}

function total_posts($u_id, $db) {
 $query = mysqli_query($db, "select count(id) as total from posts where u_id = '$u_id'");
 $total = mysqli_fetch_assoc($query);
 return $total['total'];
}

function total_comments($p_id, $db) {
 $c_query = mysqli_query($db, "select count(id) as total from comments where p_id = '$p_id'");
 $total = mysqli_fetch_assoc($c_query);
 return $total['total'];
}

function total_comments_of_all_posts($u_id, $db) {
 $p_query = mysqli_query($db, "select id from posts where u_id = '$u_id'");
 $i = 0;
 $total = 0;
 while ($post = mysqli_fetch_assoc($p_query)) {
  $response[$i]['id'] = $post['id'];
  $response[$i]['total'] = total_comments($post['id'], $db);
  $total = $total + $response[$i]['total'];
  $i = $i + 1;
 }
 return $total;
}

function average_rating($u_id, $db) {
 $r_query = mysqli_query($db, "select avg(rate) as avg from rating where u_id = '$u_id'");
 $avg = mysqli_fetch_assoc($r_query);
 return $avg['avg'];
}

function post_vs_comments($u_id, $db) {
 $p_query = mysqli_query($db, "select id from posts where u_id = '$u_id'");
 $i = 0;
 $data = array();
 while ($post = mysqli_fetch_assoc($p_query)) {
  $response[$i]['p_id'] = $post['id'];
  $response[$i]['total'] = total_comments($post['id'], $db);
  $data['posts'][$i] = $response[$i];
  $i = $i + 1;
 }
 $post_id = array();

 for ($i = 0; $i < count($data['posts']); $i++) {
  $post[$i] = $data['posts'][$i]['p_id'];
 }
 //$data['posts'][0]['total']  ===>  returns total count of comments at Oth position  ==> 3 in this case;
 return $data;
}

function post_ids($data) {
 $post_id = array();

 for ($i = 0; $i < count($data['posts']); $i++) {
  $post[$i] = 'Post ID:' . $data['posts'][$i]['p_id'];
 }
 return $post;
}

function total_comments_for_posts($data) {
 $post_id = array();

 for ($i = 0; $i < count($data['posts']); $i++) {
  $post[$i] = $data['posts'][$i]['total'];
 }
 return $post;
}

if (isset($_SESSION['userSession'])) {

 $u_id = $_SESSION['userSession'];
 ?>

 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
  <div class="row">
   <ol class="breadcrumb">
    <li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
   </ol>
  </div><!--/.row-->

  <div class="row">
   <div class="col-lg-12">
    <h1 class="page-header">Dashboard</h1>

   </div>
  </div><!--/.row-->
  <div class="row">
   <div class="col-xs-12 col-md-6 col-lg-3">
    <div class="panel panel-orange panel-widget">
     <div class="row no-padding">
      <div class="col-sm-3 col-lg-5 widget-left">
       <svg class="glyph stroked two messages"><use xlink:href="#stroked-two-messages"/></svg>
      </div>
      <div class="col-sm-9 col-lg-7 widget-right">
       <div class="large"><?php echo total_comments_of_all_posts($u_id, $db); ?></div>
       <div class="text-muted">Total Comments</div>
      </div>
     </div>
    </div>
   </div>
   <div class="col-xs-12 col-md-6 col-lg-3">
    <div class="panel panel-teal panel-widget">
     <div class="row no-padding">
      <div class="col-sm-3 col-lg-5 widget-left">
       <svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
      </div>
      <div class="col-sm-9 col-lg-7 widget-right">
       <div class="large"><?php echo total_followers($u_id, $db); ?></div>
       <div class="text-muted">Followers</div>
      </div>
     </div>
    </div>
   </div>
   <div class="col-xs-12 col-md-6 col-lg-3">
    <div class="panel panel-red panel-widget">
     <div class="row no-padding">
      <div class="col-sm-3 col-lg-5 widget-left">
       <svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
      </div>
      <div class="col-sm-9 col-lg-7 widget-right">
       <div class="large"><?php echo total_posts($u_id, $db); ?></div>
       <div class="text-muted">All Articles</div>
      </div>
     </div>
    </div>
   </div>
   <div class="col-xs-12 col-md-6 col-lg-3">
    <div class="panel panel-blue panel-widget ">
     <div class="row no-padding">
      <div class="col-sm-3 col-lg-5 widget-left">
       <svg class="glyph stroked star"><use xlink:href="#stroked-star"/></svg>
      </div>
      <div class="col-sm-9 col-lg-7 widget-right">
       <div class="large"><?php echo average_rating($u_id, $db); ?> / 5</div>
       <div class="text-muted">Author Rating</div>
      </div>
     </div>
    </div>
   </div>
  </div><!--/.row-->
  <div class="row">
   <div class="col-lg-12">
    <div class="panel panel-default">
     <div class="panel-heading">Career at Blogging - Article v/s Comments received for each articles</div>
     <div class="panel-body">
      <div class="canvas-wrapper">
       <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
      </div>
     </div>
    </div>
   </div>
  </div><!--/.row-->




 </div>	<!--/.main-->

 <script src="js/jquery-1.11.1.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/chart.min.js"></script>

 <script>
  var randomScalingFactor = function () {
   return Math.round(Math.random() * 1000);
  };

  var lineChartData = {
   labels: <?= json_encode(post_ids(post_vs_comments($u_id, $db))); ?>,
   datasets: [
    {
     label: "Posts Versus Comments",
     fillColor: "rgba(48, 164, 255, 0.2)",
     strokeColor: "rgba(48, 164, 255, 1)",
     pointColor: "rgba(48, 164, 255, 1)",
     pointStrokeColor: "#fff",
     pointHighlightFill: "#fff",
     pointHighlightStroke: "rgba(48, 164, 255, 1)",
     data: <?= json_encode(total_comments_for_posts(post_vs_comments($u_id, $db))); ?>
    }
   ]};
  window.onload = function () {
   var chart1 = document.getElementById("line-chart").getContext("2d");
   window.myLine = new Chart(chart1).Line(lineChartData, {
    responsive: true
   });
  };
 </script>

 </body>
 </html>
 <?php
} else {
 header("Location: ../login.php");
}?>