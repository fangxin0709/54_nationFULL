<?php
include_once 'db.php';
$ranks = $_POST['arr'];
$rows = $conn->query("select `id`, `rank` from `{$_POST['table']}`")->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {
    $newRank = array_search($row['id'], $ranks) + 1; // 数组索引值加1以匹配新的rank值
    $conn->exec("update `{$_POST['table']}` set `rank`='{$newRank}' where `id`='{$row['id']}'");
}