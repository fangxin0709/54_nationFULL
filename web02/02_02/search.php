<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>台北101接駁專車系統</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./bs/bootstrap.css">
    <link rel="shortcut icon" href="./img/03_ICON.png" type="image/x-icon">

    <style>
        
    </style>
</head>
<body>
    <?php include "nav.php";?>
    <div class="d-flex" style="justify-content: center;align-items: center;">
        <form action="./api/search.php" method="post" class="form shadow">
            <h1 class="text-center hi">班次查詢</h1>
            <?php if(isset($_SESSION['form'])){
            ?>
            <a href="./api/formout.php" class="nav-item">go</a>
          <?php  
        } ?>
            <label for="email">信箱</label>
            <input type="email" name="email" id="email" class="form-control form-group" placeholder="請輸入信箱" required>
            <input type="submit" class="submitBtn" value="送出">
        </form>
    </div>
</body>
<script src="./js/jquery.js"></script>
<script src="./bs/bootstrap.js"></script>
<script src="./bs/bootstrap.bundle.min.js"></script>
<script>
</script>
</html>