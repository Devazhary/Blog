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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Posts</title>
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
                <h1>My Posts</h1>
                <div class="ap-userinfo">
                    <span><?= $user['name'] ?></span>
                    <img src="../imgs/<?= $user['img'] ?>" alt="User" width="30">
                </div>
            </header>

            <section class="ap-dashboard">
                <div class="ap-content">
                    <h2>Your Posts</h2>
                    <a href="../addPost.php?id=<?= $id ?>" class="btn btn-primary" >Add Post</a>

                    <!-- If no posts -->
                    <!-- <p class="ap-no-posts">No posts yet.</p> -->

                    <!-- Uncomment for table view when posts exist -->
                    <?php if(!empty($posts)): ?>
                    <table class="table table-hover mt-3">
                        <thead>
                            <tr class="table-info">
                                <th scope="col">num</th>
                                <th scope="col" class="text-center">Title</th>
                                <th scope="col" class="text-center">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                                <?php
                                $count = 1;
                                foreach($posts as $post):
                                ?>
                                <tr>
                                    <th scope="row"><?= $count++ ?></th>
                                    <td class="text-center"><?= $post['title'] ?></td>
                                    <td class="text-center">
                                        <a href="../editPost.php?id=<?= $post['id'] ?>" class="btn btn-primary">edit</a>
                                        <a href="../handlers/handleDeletepost.php?id=<?= $post['id'] ?>" class="btn btn-danger">delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <h2 class="ap-no-posts">No posts yet.</h2>
                            <?php endif;?>

                        </tbody>
                    </table>

                </div>
            </section>
        </main>
    </div>
    <script src="js/script.js"></script>
</body>

</html>