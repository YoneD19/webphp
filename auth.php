<?php
if($_SESSION['isadmin']==0){
header("Location: login.php");
}
?>