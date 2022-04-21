<?php
include("config.php");
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Records</title>
</head>
<body>
<div class="form">
<p><a href="index.php">Home</a> 
| <a href="insert.php">Insert New Record</a> 
| <a href="logout.php">Logout</a></p>
<h2>View Records</h2>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th><strong>ID</strong></th>
<th><strong>Name</strong></th>
<th><strong>Username</strong></th>
<th><strong>Email</strong></th>
<th><strong>Password</strong></th>
<th><strong>Isadmin</strong></th>
<th><strong>Edit</strong></th>
<th><strong>Delete</strong></th>
</tr>
</thead>
<tbody>
<?php
if($_SESSION['isadmin'] == 0){
    header("location:index.php");
}else{
    $query="SELECT * FROM user";
$result = mysqli_query($mydb,$query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr><td align="center"><?php echo $row["id"]; ?></td>
<td align="center"><?php echo $row["name"]; ?></td>
<td align="center"><?php echo $row["username"]; ?></td>
<td align="center"><?php echo $row["email"]; ?></td>
<td align="center"><?php echo $row["password"]; ?></td>
<td align="center"><?php echo $row["isadmin"]; ?></td>
<td align="center">
<a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
</td>
<td align="center">
<a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
</td>
</tr>
<?php } 
}
?>
</tbody>
</table>
</div>
</body>
</html>