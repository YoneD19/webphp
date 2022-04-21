<?php
include('config.php');
include('auth.php');
if($_SESSION['isadmin'] == 0){
    header("location:index.php");
}else{
    $id=$_GET['id'];
    $query = "DELETE FROM user WHERE id=$id"; 
    $result = mysqli_query($mydb,$query);
    header("Location: view.php"); 
}
?>