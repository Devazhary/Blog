<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
  header('location:../index.php');
  exit();
}
require_once '../db/connectionDB.php';
$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Form</title>
  <link rel="stylesheet" href="style/style2.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

  <div class="card">
    <h2>Edit Profile Form</h2>

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
    <form action="../handlers/handleEditAcc.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
      <div class="input-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?= $user['name'] ?>">
      </div>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $user['email'] ?>">
      </div>
      <div class="input-group">
        <label for="image">Choose Image</label>
        <input type="file" name="img" id="">
      </div>
      <div class="image-preview" id="imagePreview">
        <span>No image chosen</span>
      </div>
      <button type="submit">Submit</button>
    </form>
    <br>
    <a class="btn btn-dark" href="account.php">Back</a>
  </div>

  <script src="js/script2.js" defer></script>
</body>
</html>
