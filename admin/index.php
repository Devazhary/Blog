<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] != true)
{
    header('location:../index.php');
    exit();
}
require_once '../db/connectionDB.php';
$id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn,$query);
$user = mysqli_fetch_assoc($result);
?>
<?php
$id = $_SESSION['user_id'];

$query = "SELECT posts.* FROM posts
INNER JOIN users
ON posts.author_id = users.id
WHERE posts.author_id = '$id'";

$result = mysqli_query($conn,$query);
$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
$myPosts = count($posts);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style/style.css">
</head>
<body class="dark-mode">
  <div class="ap-container">
    <!-- Sidebar -->
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

    <!-- Main Content -->
    <main class="ap-main">
      <header class="ap-topbar">
        <button id="openSidebar" class="ap-toggle-btn">☰</button>
        <h1>Dashboard</h1>
        <div class="ap-userinfo">
          <span><?= $user['name'] ?></span>
          <img src="../imgs/<?= $user['img'] ?>" alt="User" width="30">
        </div>
      </header>

      <section class="ap-dashboard">
        <div class="ap-stats">
          <div class="ap-card">
            <h3>My Posts</h3>
            <p><?= $myPosts ?></p>
          </div>
          <div class="ap-card">
            <h3>Joined</h3>
            <p><?= date("Y-m-d", strtotime($user['joined_at'])) ?></p>
          </div>
        </div>

        <div class="ap-content">
          <h2>Welcome, <?= $user['name'] ?>!</h2>
          <p>This is your dashboard. Use the sidebar to navigate to your posts or account settings.</p>
        </div>
      </section>
    </main>
  </div>
  <script src="js/script.js"></script>
</body>
</html>
