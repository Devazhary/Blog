<?php

session_start();
require_once "../db/connectionDB.php";

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST))
{
    $email = $_POST['email'];
    $password= $_POST['password'];
    if(!empty($email) && !empty($password))
    {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 1)
        {
            $user = mysqli_fetch_assoc($result);
            $old_password = $user['password'];
            $verify = password_verify($password,$old_password);
            if($verify){
                $_SESSION['login'] = true;
                $_SESSION['name'] = $user['name'];
                $_SESSION['user_id'] = $user['id'];
                header('location:../index.php');
                exit();
            }else{
                $_SESSION['errors'] = 'Wrong credentials';
                header('location:../login.php');
                exit();
            }
        }else{
            $_SESSION['errors'] = 'Wrong Email';
            header('location:../login.php');
            exit();
        }
    }else{
        $_SESSION['errors'] = 'Fill All Fields';
        header('location:../login.php');
        exit();
    }
}
else
{
    header('location:../login.php');
    exit();
}