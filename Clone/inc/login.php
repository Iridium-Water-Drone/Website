<?php
include("config.php");

$error = 0;

//TODO: Use statements !Security
if (isset($_POST['username']) and isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = md5("iridium".$_POST['password']);

    $query = "SELECT * FROM `accounts` WHERE username='$username' and password='$password'";
    
    if(mysqli_num_rows(mysqli_query($db, $query)) == 1) {

        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['username'] = $username;

        $_SESSION['login_string'] = hash('sha512', $password.$user_browser);

        $error = "Succes!";
    } else {
        $error = "Invalid Login Credentials";
    }
} else {
    return;
}

header("Location: ../index.php?e=$error");

?>