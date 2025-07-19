<?php 
require_once 'inc/header.php';
require_once 'db/connectionDB.php';
$id = $_GET['id'];
$query = "SELECT * FROM posts WHERE id='$id'";
$result = mysqli_query($conn,$query);
$post = mysqli_fetch_assoc($result);
?>

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new Post</h4>
              <h2>add new personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2><?= $post['title'] ?></h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="imgs/<?= $post['img'] ?>" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <p><?= $post['content'] ?></p>
            </div>
          </div>
        </div>
      </div>
</div>

    <?php require_once 'inc/footer.php' ?>
