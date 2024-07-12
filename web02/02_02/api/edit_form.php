<?php include_once "db.php";
$conn->exec("UPDATE `form` SET `name`='{$_POST['edit_name']}' WHERE `id`='{$_POST['edit_formId']}'");
header("location:../admin.php");