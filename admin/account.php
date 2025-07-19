<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
  header('location:../index.php');
  exit();
}
require_once '../db/connectionDB.php';
$id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style/style.css">
</head>

<body class="dark-mode">
  <div class="ap-container">
    <aside class="ap-sidebar closed">
      <div class="ap-sidebar-header">
        <h2 class="ap-logo">MyBlog</h2>
        <button id="closeSidebar" class="ap-toggle-btn">✖</button>
      </div>
      <ul class="ap-menu">
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="posts.php">My Posts</a></li>
        <li><a href="account.php">Account</a></li>
        <li><a href="../index.php">Home</a></li>
      </ul>
    </aside>

    <main class="ap-main">
      <header class="ap-topbar">
        <button id="openSidebar" class="ap-toggle-btn">☰</button>
        <h1>My Account</h1>
        <div class="ap-userinfo">
          <span><?= $user['name'] ?></span>
          <img src="../imgs/<?= $user['img'] ?>" alt="User" width="30">
        </div>
      </header>

      <section class="ap-dashboard">
        <div class="ap-content ap-profile-view">
          <img class="ap-profile-img" src="../imgs/<?= $user['img'] ?>" alt="User">
          <h2 class="ap-profile-name"><?= $user['name'] ?></h2>
          <p class="ap-profile-email"><?= $user['email'] ?></p>
          <p class="ap-profile-joined"><?= date("Y-m-d", strtotime($user['joined_at'])) ?></p>
          <a href="editAccount.php?id=<?= $id ?>" class="btn btn-info">Edit Account</a>
        </div>
      </section>
    </main>
  </div>
  <script src="js/script.js"></script>
</body>

</html>