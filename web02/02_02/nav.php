<nav class="navbar navbar-light navbar-expand-lg d-flex w-100" style="justify-content: space-between;align-items: center;padding: 10px;background-color: #6eabd4;">
    <div class="navbar-nav" style="display: flex;align-items: center;">
        <a href="./index.php" class="nav-item"><img class="nav-link" src="./img/bus.png" alt="" style="height: 80px;width: 100px;"></a>
        <a href="./index.php" class="nav-item"><h1 class="m-0 nav-link font-weight-bold">台北101接駁專車系統</h1></a>
        <a href="./form.php" class="nav-item"><h4 class="m-0 nav-link">接駁意願調查表單</h4></a>
        <a href="./search.php" class="nav-item"><h4 class="m-0 nav-link">班次查詢</h4></a>
    </div>
    <div class="navbar-nav">
        <a href="./admin.php" class="nav-item"><h4 class="m-0 nav-link">系統管理</h4></a>
        <?php if(isset($_SESSION['login'])){
            ?>
            <a href="./api/logout.php" class="nav-item"><h4 class="m-0 nav-link">登出</h4></a>
          <?php  
        } ?>
        </div>
</nav>