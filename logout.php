<?php

session_start();
unset($_SESSION['login']);
unset($_SESSION['name']);
unset($_SESSION['user_id']);

header('location:index.php');
exit();
?>