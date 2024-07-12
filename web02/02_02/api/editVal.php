<?php include_once "db.php";
$conn->exec("UPDATE `indexval` SET `editVal`='{$_POST['editVal']}'");
header("location:../admin.php");