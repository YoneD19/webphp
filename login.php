<?php
    require("config.php");
    if(!empty($_SESSION["id"])){
        header("location:index.php");
    }
    if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($mydb,"SELECT * FROM user WHERE email ='$email'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        if($password == $row['password']){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            header("location:index.php");
        }else{
            echo
            "<script>alert('Wrong password');</script>";
        }
    }else{
        echo
        "<script>alert('User not registered');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post" autocomplete="off">
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" require value=""><br>
    <label for="password" method="post" autocomplete="off">Password:</label>
    <input type="password" name="password" id="password" require value=""><br>
    <button type="submit" name="submit">Login</button><br>
    <a href="register.php">Register</a>
    </form>
</body>
</html>