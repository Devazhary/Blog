<?php

require_once "../db/connectionDB.php";
$id = $_GET['id'];
$query = "DELETE FROM `posts` WHERE `id` = '$id'";
$result = mysqli_query($conn,$query);

header('Location:../admin/posts.php');
exit();
