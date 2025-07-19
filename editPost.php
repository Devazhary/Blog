<?php 
require_once 'inc/header.php';
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
  header('location:../index.php');
  exit();
}
require_once 'db/connectionDB.php';
$id = $_GET['id'];
$query = "SELECT * FROM posts WHERE id='$id'";
$result = mysqli_query($conn, $query);
$post = mysqli_fetch_assoc($result);
?>
 <!-- Page Content -->
 <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Edit Post</h4>
              <h2>edit your personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

<div class="container w-50 ">
<div class="d-flex justify-content-center">
    <h3 class="my-5">edit Post</h3>
  </div>
    <?php if(isset($_SESSION['errors'])): ?>
            <?php foreach($_SESSION['errors'] as $error): ?>
            <div class="alert alert-danger text-center">
                <?= $error ?>
            </div>
        <?php endforeach;
        unset($_SESSION['errors']);
     endif; ?>

    <?php if(isset($_SESSION['success'])): ?>
            <?php foreach($_SESSION['success'] as $success): ?>
            <div class="alert alert-success text-center">
                <?= $success ?>
            </div>
        <?php endforeach;
        unset($_SESSION['success']);
    endif; ?>
    <form method="post" action="handlers/handleEditPost.php?id=<?= $id ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $post['title'] ?>">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" rows="5"><?= $post['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" id="body" name="content" rows="5"><?= $post['content'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">image</label>
            <input type="file" class="form-control-file" id="image" name="image" >
        </div>
        
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>


<?php require_once 'inc/footer.php' ?>