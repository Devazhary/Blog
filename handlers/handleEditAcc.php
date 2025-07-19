<?php

session_start();
require_once "../db/connectionDB.php";
include_once "validation2.php";

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST))
{
    $errors = [];
    $query = "SELECT email FROM users";
    $result = mysqli_query($conn,$query);
    $emails = array_column(mysqli_fetch_all($result,MYSQLI_ASSOC),'email');

    foreach($validates as $validate_name => $validate_value)
    {
        $options = isset($validate_value['myOptions']) ? $validate_value['myOptions'] : null;
        $value = filter_input(INPUT_POST,$validate_name,$validate_value['filter'],$options);
        if(empty($_POST[$validate_name]))
        {
            $errors[] = "$validate_name Field Is Required";
        }elseif(!$value)
        {
            $errors[] = $validate_value['error'];
        }
    }
    if(in_array($_POST['email'],$emails))
    {
        $errors[] = "Email already exists";
    }
    $img = $_FILES['img'];
    $imgExtensions = ['png','jpg','jpeg','svg','gif'];
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
        $name = $_POST['name'];
        $email = $_POST['email'];

        if(isset($newImg))
        {
            $query = "UPDATE `users` SET `name` = '$name', `email` = '$email', `img` = '$newImg' WHERE id = '$id'";
            $result = mysqli_query($conn,$query);

        }else{
            $query = "UPDATE `users` SET `name` = '$name', `email` = '$email' WHERE id = '$id'";
            $result = mysqli_query($conn,$query);
        }

        if($result){
            $affected = mysqli_affected_rows($conn);
            if ($affected > 0) {
                $success[] = 'Updated successfully';
                $_SESSION['success'] = $success;
                header("Location:../admin/editAccount.php?id=".$id);
                exit;
            } else {
                $errors[] = 'Something Wrong Happened';
                $_SESSION['errors'] = $errors;
                header("Location:../admin/editAccount.php?id=".$id);
                exit;
            }
        }

    }else{
        $_SESSION['errors'] = $errors;
        header("Location:../admin/editAccount.php?id=".$id);
        exit;
    }
}
else
{
    header("Location:../admin/editAccount.php?id=".$id);
    exit();
}
