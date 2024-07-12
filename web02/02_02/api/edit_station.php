<?php include_once "db.php";
$conn->exec("UPDATE `station` SET `minute`='{$_POST['edit_stationMin']}',`waiting`='{$_POST['edit_waiting']}' WHERE `id`='{$_POST['edit_stationId']}'");
header("location:../admin.php");