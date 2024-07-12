<?php include_once "db.php";
$conn->exec("INSERT INTO `bus`(`busName`, `minute`) VALUES ('{$_POST['busName']}','{$_POST['add_busMin']}')");
header("location:../admin.php");