<?php include_once "db.php";
if($_POST['needBus']==0){
    ?>
    <script>
        alert("目前無法派遣");
        location.href="../admin.php";
    </script>
    <?php
    exit();
}
$users = $conn->query("select * from `form` where `checked`=1 AND `close`=1")->fetchAll(PDO::FETCH_ASSOC);
for($i=0;$i<$_POST['needBus'];$i++){
    $bus_num = "AUTO-" . sprintf("%04d",rand(1,9999));
    $start = $i * 50;
    $end = $start + 50;
    for($j=$start;$j<$end && $j<count($users);$j++){
        $user = $users[$j];
        $conn->exec("update `form` set `takeBus`='$bus_num',`close`=0 where `id`='{$user['id']}'");
    }
}
$conn->exec("update `formopen` set `active`='0'");
?>
<script>
    alert("已分配!");
    location.href="../admin.php";
</script>