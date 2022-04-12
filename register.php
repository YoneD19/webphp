<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    header("location:index.php");
}
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $dup = mysqli_query($mydb,"SELECT * FROM user WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($dup)>0){
        echo
        "<script>alert('Username or Email has already taken');</script>";
    }else{
        $query = "INSERT INTO user VALUES(NULL,'$name','$username','$email','$password','0')";
        mysqli_query($mydb,$query);
        echo
        "<script>alert('Success');</script>";
    }
}   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="" method="post" autocomplete="off">
    <label for="name">Name:</label>
    <input type="text" name="name" id = "name" required value=""><br>
    <label for="username">Username:</label>
    <input type="text" name="username" id = "username" required value=""><br>
    <label for="email">Email:</label>
    <input type="text" name="email" id = "email" required value=""><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id = "password" required value=""><br>
    <button type="submit" name="submit">Register</button> 
    </form><br>
    <a href="login.php">Login</a>
</body>
</html>