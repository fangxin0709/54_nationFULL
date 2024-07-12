<?php include_once "db.php";
$conn->exec("UPDATE `form` set `checked`='0' where `id`='{$_POST['id']}'");
header("location:../admin.php");