<?php include_once "./api/db.php";
$rows = $conn->query("select `id`,`name`,`email`,`takeBus` from `form` where `checked`=1 AND `close`=0")->fetchAll(PDO::FETCH_ASSOC);
$allBus = [];
foreach($rows as $row){
    $takeBus = $row['takeBus'];
    if(!isset($allBus[$takeBus])){
        $allBus[$takeBus] = [
            "bus" => $takeBus,
            "participants" => [],
        ];
    }
    unset($row['takeBus']);
    $allBus[$takeBus]['participants'][]=$row;
}
$get = array_values($allBus);
echo json_encode($get ,JSON_UNESCAPED_UNICODE);