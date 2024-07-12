<?php session_start();
unset($_SESSION['form']);
header("location:../form.php");