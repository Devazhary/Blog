<?php

session_start();
require_once "../db/connectionDB.php";
$id = $_POST['authorId'];

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST))
{
    $errors = [];
    $title = trim(htmlspecialchars($_POST['title']));
    $description = trim(htmlspecialchars($_POST['description']));
    $content = trim(htmlspecialchars($_POST['content']));
    $authorId = $_POST['authorId'];
    $img = $_FILES['image'];
    $imgExtensions = ['png','jpg','jpeg','svg','gif'];

    if(empty($title)){
        $errors[] = "Please fill title field";
    }elseif(is_numeric($title)){
        $errors[] = "Title must be string";
    }

    if(empty($description)){
        $errors[] = "Please fill description field";
    }elseif(is_numeric($description)){
        $errors[] = "description must be string";
    }

    if(empty($content)){
        $errors[] = "Please fill content field";
    }elseif(is_numeric($content)){
        $errors[] = "content must be string";
    }


    if(empty($img['name'])){
        $newImg = 'missingImg.png';
    }else{
        $ext = pathinfo($img['name'],PATHINFO_EXTENSION);
        if(!in_array($ext,$imgExtensions))
        {
            $errors[] = "Please put img";
        }else{
            $newImg = uniqid('blog-') . '.' . $ext;
            move_uploaded_file($img['tmp_name'],'../imgs/'.$newImg);
        }
    }

    if(empty($errors))
    {

        $query = "INSERT INTO `posts`(`title`,`description`,`content`,`img`,`author_id`) VALUES ('$title','$description','$content','$newImg','$authorId')";
        $result = mysqli_query($conn,$query);

        if($result){
            $affected = mysqli_affected_rows($conn);
            if ($affected > 0) {
                header('Location:../index.php');
                exit;
            } else {
                $errors[] = 'Something Wrong Happened';
                $_SESSION['errors'] = $errors;
                header("Location:../addPost.php?id=".$id);
                exit;
            }
        }

    }else{
        $_SESSION['errors'] = $errors;
        header("Location:../addPost.php?id=".$id);
        exit;
    }
}
else
{
    header("Location:../addPost.php?id=".$id);
    exit();
}
