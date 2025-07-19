<?php require_once 'inc/header.php';
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] != true)
{
    header('location:../index.php');
    exit();
}
$userId = $_GET['id'];
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

    
<div class="container w-50 ">
  <div class="d-flex justify-content-center">
    <h3 class="my-5">add new Post</h3>
  </div>
  <?php if(isset($_SESSION['errors'])): ?>
            <?php foreach($_SESSION['errors'] as $error): ?>
            <div class="alert alert-danger text-center">
                <?= $error ?>
            </div>
        <?php endforeach;
        unset($_SESSION['errors']);
  endif; ?>
  <form method="POST" action="handlers/handleAddPost.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Content</label>
        <textarea class="form-control" id="body" name="content" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">image</label>
        <input type="file" class="form-control-file" id="image" name="image" >
    </div>
    <input type="hidden" class="form-control-file" name="authorId" value="<?= $userId ?>">
    <!-- <img src="uploads/<?php echo $post['image'] ?>" alt="" width="100px" srcset=""> -->
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </form>
</div>

    <?php require_once 'inc/footer.php' ?>
