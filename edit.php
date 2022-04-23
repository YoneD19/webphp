<?php
include("config.php");
include("auth.php");
$id=$_GET['id'];
$query = "SELECT * from user where id='$id'"; 
$result = mysqli_query($mydb, $query);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Record</title>
</head>
<body>
<div class="form">
<p><a href="dashboard.php">Dashboard</a> 
| <a href="insert.php">Insert New Record</a> 
| <a href="logout.php">Logout</a></p>
<h1>Update Record</h1>
<?php
if($_SESSION['isadmin'] == 0){
    header("location:index.php");
}else{
    $status = "";
    if(isset($_POST['edit']) && $_POST['edit']==1){
    $id=$_GET['id'];
    $name =$_POST['name'];
    $username =$_POST['username'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $isadmin =$_POST['isadmin'];
    $dup = mysqli_query($mydb,"SELECT * FROM user WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($dup)>0){
        echo
        "<script>alert('Username or Email has already taken');</script></br>
        <a href='view.php'>View Updated Record</a>";
    }else{
        $update="UPDATE user set name='$name', username='$username', 
        email='$email',password='$password',isadmin='$isadmin' where id='$id'";
        mysqli_query($mydb, $update);
        $status = "Successfully. </br></br>
        <a href='view.php'>View Updated Record</a>";
        echo '<p>'.$status.'</p>';
    }

    }else {
    ?>
    <div>
    <form name="form" method="post" action=""> 
    <input type="hidden" name="edit" value="1" />
    <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
    <p><input type="text" name="name" placeholder="Name" 
    required value="<?php echo $row['name'];?>" /></p>
    <p><input type="text" name="username" placeholder="Username" 
    required value="<?php echo $row['username'];?>" /></p>
    <p><input type="text" name="email" placeholder="Email" 
    required value="<?php echo $row['email'];?>" /></p>
    <p><input type="text" name="password" placeholder="Password" 
    required value="<?php echo $row['password'];?>" /></p>
    <p><input type="text" name="isadmin" placeholder="Isadmin" 
    required value="<?php echo $row['isadmin'];?>" /></p>
    <p><input name="submit" type="submit" value="Update" /></p>
    </form>
    <?php }
}
 ?>
</div>
</div>
</body>
</html>