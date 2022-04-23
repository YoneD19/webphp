<?php
    require "config.php";
    if(isset($_SESSION["id"])){
        $id = $_SESSION["id"];
        $result = mysqli_query($mydb,"SELECT * FROM user WHERE id = '$id'");
        $row = mysqli_fetch_assoc($result);
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
    <title>Document</title>
</head>
<body>
    <h1>Welcome <?php echo $row["username"] ?></h1>
    <p><a href="profile.php?username=<?php echo $row["username"]; ?>">Your Profile</a> |
    <?php 
        if($_SESSION["isadmin"] == '1'){
            echo
            '<a href="dashboard.php">Dashboard</a>';
            echo ' | ';
        }
    ?>
    <a href="logout.php">Logout</a></p>
    <h2>Search Username below:</h2>
    <form action="profile.php" method="GET">
        <label for="username" id="username">Username:</label>
        <input type="text" id="username" name="username">
        <input type="submit" id="" name="submit" value="Search"><br>
    </form>
    <h1>ALL POST</h1>
<?php
    $myquery = "SELECT * FROM post";
    $res = mysqli_query($mydb,$myquery);
    $count = 1;
    while ($row = $res->fetch_assoc()) {
        $title = $row['title'];
        $content = $row['content'];
        echo '<h2>'.$count.'.'.$title.'</h2>';
        echo $content;
        echo '</br>-----------------------------------------------------------------------------';
        $count++;
        }
?>
</body>
</html>