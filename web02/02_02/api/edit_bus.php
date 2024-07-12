<?php include_once "db.php";
$conn->exec("UPDATE `bus` SET `minute`='{$_POST['edit_busMin']}' WHERE `id`='{$_POST['edit_busId']}'");
header("location:../admin.php");