<?php include_once "db.php";
$checkE = $conn->query("select count(*) from `form` where `email`='{$_POST['email']}'")->fetchColumn();
if($checkE==0){
    $conn->exec("INSERT INTO `form`(`email`) VALUES ('{$_POST['email']}')");
    header("location:../admin.php");
}else{
    ?>
    <script>
        alert("已有此參與者!");
    </script>
    <?php
}