<?php include_once "db.php";
$checkF = $conn->query("select `active` from `formopen` limit 1 ")->fetchColumn();
if($checkF == 0){
    ?>
    <script>
        alert("該表單目前不接受回應");
        location.href = "../form.php";
    </script>
   <?php
   exit();
}
$checkE = $conn->query("select count(*) from `form` where `email`='{$_POST['email']}'")->fetchColumn();
if($checkE == 0){
    ?>
    <script>
        alert("您不在參與者名單中");
        location.href = "../form.php";
    </script>
    <?php
    exit();
}
$check = $conn->query("select `checked` from `form` where `email`='{$_POST['email']}'")->fetchColumn();
if($check == 0 && $checkE ==1){
    $conn->exec("update `form` set `checked`='1',`name`='{$_POST['name']}' where `email`='{$_POST['email']}'");
    ?>
    <script>
        alert("tks");
        location.href = "../form.php";
    </script>
    <?php
}else if($check == 1){
    ?>
    <script>
        alert("您已經參與過意見調查");
        location.href = "../form.php";
    </script>
    <?php
}