<?php include_once "./api/db.php";
$rows = $conn->query("select `id`,`email` from `form`")->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows);