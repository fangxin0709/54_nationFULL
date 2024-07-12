<?php include_once "db.php";
$max = $conn->query("select max(`rank`) as maxRank from `station`")->fetchColumn();
$new = $max+1;
$conn->exec("INSERT INTO `station`(`stationName`, `minute`,`waiting`,`rank`) VALUES ('{$_POST['stationName']}','{$_POST['add_stationMin']}','{$_POST['waiting']}','$new')");
header("location:../admin.php");