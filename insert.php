<?php
    include "config.php";
    if($_SESSION['isadmin'] == 0){
        header("location:index.php");
    }else{
        $status = "";
        if(isset($_POST['add']) && $_POST['add']==1){
            $name =$_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $isadmin = $_POST['isadmin'];
            $dup = mysqli_query($mydb,"SELECT * FROM user WHERE username = '$username' OR email = '$email'");
            if(mysqli_num_rows($dup)>0){
                echo
                "<script>alert('Username or Email has already taken');</script>";
            }else{
                $query="INSERT into user values(NULL,'$name','$username','$email','$password','$isadmin')";
                mysqli_query($mydb,$query);
                $status = "Successfully.";
            }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert New Record</title>
</head>
<body>
<div class="form">
<p><a href="dashboard.php">Dashboard</a> 
| <a href="view.php">View Records</a> 
| <a href="logout.php">Logout</a></p>
<div>
<h1>Insert New Record</h1>
<form name="form" method="post" action=""> 
<input type="hidden" name="add" value="1" />
<p><input type="text" name="name" placeholder="Name" required /></p>
<p><input type="text" name="username" placeholder="Username" prequired /></p>
<p><input type="text" name="email" placeholder="Email" required /></p>
<p><input type="text" name="password" placeholder="Password" required /></p>
<p><input type="text" name="isadmin" placeholder="Isadmin" required /></p>
<p><input name="submit" type="submit" value="Submit" /></p>
</form>
<p><?php echo $status; ?></p>
</div>
</div>
</body>
</html>