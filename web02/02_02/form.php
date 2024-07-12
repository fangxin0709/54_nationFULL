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
        <form action="./api/res_form.php" method="post" class="form shadow">
            <h1 class="text-center hi">接駁意願調查表單</h1>
            <label for="name">姓名</label>
            <input type="text" name="name" id="name" class="form-control form-group" placeholder="請輸入姓名" required>
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