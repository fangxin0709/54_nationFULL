<?php include_once "db.php";
session_start();
if($_POST['veri']!=$_SESSION['veri']){
    ?>
    <script>
        alert("veri err");
        location.href ="../login.php";
    </script>
    <?php
    exit();
}
if($_POST['acc']=="admin" && $_POST['pw']=="1234"){
    $_SESSION['login'] = "ok";
    ?>
    <script>
        alert("welcome");
        location.href ="../admin.php";
    </script>
    <?php
}else{
    ?>
    <script>
        alert("pw or acc err");
        location.href ="../login.php";
    </script>
    <?php
    exit();
}