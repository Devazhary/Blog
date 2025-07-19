<?php

session_start();
require_once "../db/connectionDB.php";
include_once "validation.php";

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST))
{
    $errors = [];
    $query = "SELECT email FROM users";
    $result = mysqli_query($conn,$query);
    $emails = array_column(mysqli_fetch_all($result,MYSQLI_ASSOC),'email');

    foreach($validates as $validate_name => $validate_value)
    {
        $value = filter_input(INPUT_POST,$validate_name,$validate_value['filter'],$validate_value['myOptions']);
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
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

        if(isset($newImg))
        {
            $query = "INSERT INTO `users`(`name`,`email`,`password`,`img`) VALUES ('$name','$email','$password','$newImg')";
            $result = mysqli_query($conn,$query);

        }else{
            $newImg = 'user.png';
            $query = "INSERT INTO `users`(`name`,`email`,`password`,`img`) VALUES ('$name','$email','$password','$newImg')";
            $result = mysqli_query($conn,$query);
        }

        if($result){
            $affected = mysqli_affected_rows($conn);
            if ($affected > 0) {
                header('location:../Login.php');
                exit;
            } else {
                $errors[] = 'Something Wrong Happened';
                $_SESSION['errors'] = $errors;
                header('location:../register.php');
                exit;
            }
        }

    }else{
        $_SESSION['errors'] = $errors;
        header('location:../register.php');
        exit;
    }
}
else
{
    header('location:../register.php');
    exit();
}