<?php include_once "db.php";
$row = $conn->query("SELECT * FROM `{$_GET['table']}` WHERE `id`='{$_GET['id']}'")->fetch(PDO::FETCH_ASSOC);
echo json_encode($row);