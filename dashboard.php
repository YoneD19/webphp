<?php
    require "config.php";
    if(empty($_SESSION['id'])){
    header("location:login.php");
    }
    if($_SESSION['isadmin'] == 0){
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dash Board</title>
</head>
<body>
<a href="index.php">HOME</a>
<?php     
        echo
        '<form action="" method="post">
        <div  style="border:solid thin #aaa;padding: 10px;width: 400px;>
        <label for="Tittle">name:&nbsp&nbsp&nbsp&nbsp</label>
            <input type="text" id="name" name="name" size="40" required value=""><br><br>
        <label for="Tittle">username:&nbsp&nbsp&nbsp&nbsp</label>
            <input type="text" id="username" name="username" size="40" required value=""><br><br> 
        <label for="Tittle">email:&nbsp&nbsp&nbsp&nbsp</label>
            <input type="text" id="email" name="email" size="40" required value=""><br><br>     
        <label for="Tittle">password:&nbsp&nbsp&nbsp&nbsp</label>
            <input type="text" id="password" name="password" size="40" required value=""><br><br> 
        <label for="Tittle">isadmin:&nbsp&nbsp&nbsp&nbsp</label>
            <input type="text" id="isadmin" name="isadmin" size="40" required value=""><br><br> 
            <button type="submit" name="submit">Add user</button>
            </div>
        </form>';
    
    if(isset($_POST["submit"])){
        $name = $_POST["name"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $isadmin = $_POST["isadmin"];
        $sql = "INSERT INTO user VALUES(NULL,'$name','$username','$email','$password','$isadmin') ";
        mysqli_query($mydb,$sql);
    }
echo '<br><br>';
        $sql = "SELECT * FROM user";
        $result = mysqli_query($mydb,$sql);
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $username = $row["username"];
            $email = $row["email"];
            $password = $row["password"];
            $id = $row["id"];
            echo 
            '<form action="" method="post">
            <div  style="border:solid thin #aaa;padding: 10px;width: 400px;>
             <label for="Name">Name:&nbsp&nbsp&nbsp&nbsp</label>
                 <input type="text" id="name" name="name" size="40"  value="'.$name.'"><br><br>
                 <label for="Name">Username:&nbsp&nbsp&nbsp&nbsp</label>
                 <input type="text" id="username" name="username" size="40"  value="'.$username.'"><br><br>
                 <label for="Name">Email:&nbsp&nbsp&nbsp&nbsp</label>
                 <input type="text" id="email" name="email" size="40"  value="'.$email.'"><br><br>
                 <label for="Name">Password:&nbsp&nbsp&nbsp&nbsp</label>
                 <input type="text" id="password" name="password" size="40"  value="'.$password.'"><br><br>
                 <input type="hidden" name="id" value="'.$id.'">
                <button type="submit" name="action" value="save_'.$count.'">Save</button>
                <button type="submit" name="action" value="delete_'.$count.'">Delete</button>
             </div><br>
             </form>';
            $count++;
    }
    for($i=0;$i<$count;$i++){
        if($_POST["action"] == "save_$i"){
            $name =  $_POST["name"];
            $username =  $_POST["username"];
            $email =  $_POST["email"];
            $password =  $_POST["password"];
            $id = $_POST["id"];
            mysqli_query($mydb, "UPDATE user SET name='$name', username='$username',email='$email',password='$password' WHERE id='$id'");
            header("location:dashboard.php?");
        }          
        if($_POST["action"] == "delete_$i"){
            $id = $_POST["id"];
            mysqli_query($mydb, "DELETE FROM user WHERE id='$id'");
            mysqli_query($mydb, "DELETE FROM post WHERE user_id='$id'");
            header("location:dashboard.php?");
        }     
    };

?>
</body>
</html>
