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
        <form action="./api/login.php" method="post" class="form shadow">
            <h1 class="text-center hi">網站管理-登入</h1>
            <label for="acc">帳號</label>
            <input type="text" name="acc" id="acc" class="form-control form-group" placeholder="請輸入帳號" required>
            <label for="pw">密碼</label>
            <input type="password" name="pw" id="pw" style="width:380px" class="form-control form-group" placeholder="請輸入密碼" required>
            <label for="veri">驗證碼</label>
            <input type="text" name="veri" id="veri" class="form-control form-group" placeholder="請輸入驗證碼" required>
            <div class="d-flex m-2" style="align-items: center;flex-direction: row-reverse;">
                <div class="veri ml-2">0000</div>
                <div class="btn btn-success" onclick="rc()">重新產生驗證碼</div>
            </div>
            <input type="submit" class="submitBtn" value="登入">
        </form>
    </div>
</body>
<script src="./js/jquery.js"></script>
<script src="./bs/bootstrap.js"></script>
<script src="./bs/bootstrap.bundle.min.js"></script>
<script>
    $(".veri").load("./veri.php");
    function rc(){
        $(".veri").load("./veri.php");
    }
</script>
</html>