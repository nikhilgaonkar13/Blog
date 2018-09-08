<?php
include '../includes/config.php';
include '../includes/db.php';

$id = (int)$_GET['post'];

$query = "Delete from posts where id = '$id'";

mysqli_query($db, $query);

header("Location: posts.php");

?>