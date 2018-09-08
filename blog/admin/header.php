<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lumino - Dashboard</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/datepicker3.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">

  <!--Icons-->
  <script src="js/lumino.glyphs.js"></script>

  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

 </head>

 <body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   <div class="container-fluid">
    <div class="navbar-header">
     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
     </button>
     <a class="navbar-brand" href="#"><span>Blogger</span>Admin</a>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="../index.php" target="_blank"><span class="glyphicon glyphicon-new-window"></span> View Site</a></li>
      <li><a href="../logout.php?logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
     </ul>
    </div>

   </div><!-- /.container-fluid -->
  </nav>

  <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
   <ul class="nav menu">
    <li><a href="index.php"><span class="glyphicon glyphicon-time"></span> Dashboard</a></li>
    <li><a href="posts.php"><span class="glyphicon glyphicon-bookmark"></span> Posts</a></li>
    <li><a href="followers.php"><span class="glyphicon glyphicon-user"></span> Followers</a></li>
    <li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span> Comments</a></li>
    <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
   </ul>

  </div><!--/.sidebar-->
