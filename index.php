<?php require_once 'inc/header.php';
require_once 'db/connectionDB.php';

if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
}

$limit = 3;
$offset = ($page - 1) * $limit;


$query2 = "SELECT COUNT(*) AS total FROM posts";
$queResult = mysqli_query($conn,$query2);
$totalPosts = mysqli_fetch_assoc($queResult)['total'];

$numOfPages = ceil($totalPosts / $limit);

if($page < 1)
{
  header("location:index.php?page=1");
  exit();
}else if($page > $numOfPages)
{
  header("location:index.php?page=$numOfPages");
  exit();
}

$query = "SELECT * FROM posts ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn,$query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->
    
    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Posts</h2>
              <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
          </div>
          
          <?php if(empty($posts)): ?>
            <div class="text-center">
              <h2>No Posts Yet</h2>
            </div>
          <?php else:
            foreach($posts as $post):
          ?>
            <div class="col-md-4">
              <div class="product-item">
                <a href="#"><img src="imgs/<?= $post['img'] ?>"></a>
                <div class="down-content">
                  <a href="#"><h4><?= $post['title'] ?></a>
                  <p><?= $post['description'] ?></p>
                  <div class="d-flex justify-content-end">
                    <a href="viewPost.php?id=<?= $post['id'] ?>" class="btn btn-info ">view</a>
                  </div>
                  
                </div>
              </div>
            </div>
          <?php endforeach;endif; ?>

        </div>
      </div>
      <nav aria-label="Page navigation example" class="d-flex justify-content-center">
      <ul class="pagination">
        <li class="page-item <?php if($page == 1) echo 'disabled' ?>"><a class="page-link" href="index.php?page=<?= $page - 1 ?>">Previous</a></li>
        <?php for($i = 1; $i <= $numOfPages; $i++): ?>
        <li class="page-item"><a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
        <?php endfor ?>
        <li class="page-item <?php if($page == $numOfPages) echo 'disabled' ?>"><a class="page-link" href="index.php?page=<?= $page + 1 ?>">Next</a></li>
      </ul>
    </nav>
    </div>

 
    
<?php require_once 'inc/footer.php' ?>
