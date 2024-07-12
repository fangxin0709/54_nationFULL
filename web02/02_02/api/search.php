<?php include_once "db.php";
$checkE = $conn->query("select count(*) from `form` where `email`='{$_POST['email']}'")->fetchColumn();
if($checkE == 0){
    ?>
    <script>
        alert("您不在參與名單當中");
        location.href = "../search.php";
    </script>
    <?php
    exit();
}
$check = $conn->query("select `checked` from `form` where `email`='{$_POST['email']}'")->fetchColumn();
$takeBus = $conn->query("select `takeBus` from `form` where `email`='{$_POST['email']}'")->fetchColumn();
$checkB = !empty($takeBus) ? 1 : 0;
if($check == 0 && $checkE ==1){
    session_start();
    $_SESSION['form']="0";
    ?>
    <script>
        alert("您還沒填寫意願調查表單");
        location.href = "../search.php";
    </script>
    <?php
}else if($check == 1 && $checkE==1 && $checkB==1){
    ?>
    <script>
        alert("your bus : <?=$takeBus?>");
        location.href = "../search.php";
    </script>
    <?php
}else if($check == 1 && $checkE==1 && $checkB==0){
    ?>
    <script>
        alert("目前尚未分配接駁車");
        location.href = "../search.php";
    </script>
    <?php
}