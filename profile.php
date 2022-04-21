<?php
    require "config.php";
    $username = $_GET["username"];
    if(!empty($_SESSION['id'])){
        if(isset($_GET["username"])){
            
            $myquery = "SELECT * FROM user WHERE username ='$username'";
            $result = mysqli_query($mydb,$myquery);
            if(mysqli_num_rows($result) >0){
                $row = mysqli_fetch_assoc($result);
                $email = $row["email"];
    
            }else{
                die('User not found.Try again');
         
            }
        }else{
            die ("need a username");
        }

    }else{
        header("location:login.php");
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User profile</title>
</head>
<body>
    <h1><?php echo $row["username"] ?>'s Profile</h1>
    <label for="">Username:<?php echo $username ?></label><br>
    <label for="">Email:<?php echo $email ?></label><br>
<a href="index.php">HOME</a>
<?php 
    if($_SESSION["username"] == $row["username"]){
        echo
        '<form action="" method="post">
        <div  style="border:solid thin #aaa;padding: 10px;width: 400px;>
        <label for="Tittle">Tittle:&nbsp&nbsp&nbsp&nbsp</label>
            <input type="hidden" name="post" value="1" />
            <input type="text" id="title" name="title" size="40" required value=""><br><br>
            <label for="Content">Content:</label>
            <textarea id="content" name="content" rows="6" cols="48" required value=""></textarea>
            <button type="submit" name="submit">Post</button>
        </div>
        </form>';
    }
    $uname = $row["username"];
    $userid = $_SESSION["id"];
    if(isset($_POST["post"]) && $_POST["post"] == 1 && $_SESSION["username"] ==$uname){
        $title = $_POST["title"];
        $content = $_POST["content"];
        $sql = "INSERT INTO post VALUES(NULL,'$title','$content','$userid') ";
        mysqli_query($mydb,$sql);
    }

        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($mydb,$sql);
        $uid = mysqli_fetch_assoc($result)["id"];
        $myquery = "SELECT * FROM post WHERE user_id = '$uid'";
        $res = mysqli_query($mydb,$myquery);
        echo
        '<h2>'.$uname.' Story</h2>';
        $count = 0;
        while ($row = $res->fetch_assoc()) {
            $title = $row["title"];
            $content = $row["content"];
            $post_id = $row["post_id"];
             echo 
            '<form action="" method="post">
            <div  style="border:solid thin #aaa;padding: 10px;width: 400px;>
             <label for="Tittle">Tittle:&nbsp&nbsp&nbsp&nbsp</label>
                 <input type="text" id="title" name="title" size="40"  value="'.$title.'"><br><br>
                 <label for="Content">Content:</label>
                 <textarea id="content" name="content" rows="6" cols="48"  >'.$content.'</textarea>
                 <input type="hidden" name="id" value="'.$post_id.'">';  
            if($_SESSION["username"] == $uname){
                echo
                '
                <button type="submit" name="action" value="save_'.$count.'">Save</button>
                <button type="submit" name="action" value="delete_'.$count.'">Delete</button>
                ';
            }
                 echo'
             </div><br>
             </form>';
            $count++;
        }
        for($i=0;$i<$count;$i++){
            if($_POST["action"] == "save_$i" && $_SESSION["username"] ==$uname){
                $title =  $_POST["title"];
                $content =  $_POST["content"];
                $id = $_POST["id"];
                mysqli_query($mydb, "UPDATE post SET title='$title', content='$content' WHERE post_id='$id'");
                header("location:profile.php?username=$uname");
            }          
            if($_POST["action"] == "delete_$i" && $_SESSION["username"] ==$uname){
                $id = $_POST["id"];
                mysqli_query($mydb, "DELETE FROM post WHERE post_id='$id'");
                header("location:profile.php?username=$uname");
            }     
        };

?>
</body>
</html>
