<?php include_once "db.php";
$conn->exec("DELETE FROM `{$_POST['table']}` WHERE `id`='{$_POST['id']}'");
header("location:../admin.php");