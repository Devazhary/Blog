<?php

session_start();
require_once "../db/connectionDB.php";
include_once "validation2.php";

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST))
{
    $errors = [];
    $title = trim(htmlspecialchars($_POST['title']));
    $description = trim(htmlspecialchars($_POST['description']));
    $content = trim(htmlspecialchars($_POST['content']));
    
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

    if(!empty($img['name']))
    {
        $ext = pathinfo($img['name'],PATHINFO_EXTENSION);
        if(!in_array($ext,$imgExtensions))
        {
            $errors[] = "Please Put Img Not Other File";
        }else{
            $newImg = uniqid('blog-') . '.' . $ext;
            move_uploaded_file($img['tmp_name'],'../imgs/'.$newImg);
        }
    }

    if(empty($errors))
    {
        if(isset($newImg))
        {
            $query = "UPDATE posts SET `title` = '$title', `description` = '$description', `content` = '$content', `img` = '$newImg' WHERE `id` = '$id'";
            $result = mysqli_query($conn,$query);

        }else{
            $query = "UPDATE posts SET `title` = '$title', `description` = '$description', `content` = '$content' WHERE `id` = '$id'";
            $result = mysqli_query($conn,$query);
        }

        if($result){
            $affected = mysqli_affected_rows($conn);
            if ($affected > 0) {
                $success[] = 'Updated successfully';
                $_SESSION['success'] = $success;
                header("Location:../editPost.php?id=".$id);
                exit;
            } else if($affected == 0) {
                $errors[] = 'Same data nothing change';
                $_SESSION['errors'] = $errors;
                header("Location:../editPost.php?id=".$id);
                exit;
            } else if($affected == 0) {
                $errors[] = 'Something Wrong Happened';
                $_SESSION['errors'] = $errors;
                header("Location:../editPost.php?id=".$id);
                exit;
            }
        }

    }else{
        $_SESSION['errors'] = $errors;
        header("Location:../editPost.php?id=".$id);
        exit;
    }
}
else
{
    header("Location:../editPost.php?id=".$id);
    exit();
}
