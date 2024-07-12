<?php include_once "db.php";
$conn->exec("UPDATE `formopen` SET `active`='{$_POST['active']}'");
header("location:../admin.php");