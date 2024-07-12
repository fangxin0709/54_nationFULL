<?php session_start();
if(!isset($_SESSION['login'])){
    ?>
<script>
    alert("請先登入!");
    location.href = "./login.php";
</script>
<?php
}
?>
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
        td:first-child {
            border-radius: 10px 0 0 10px;
        }

        td:last-child {
            border-radius: 0px 10px 10px 0px;
        }

        tr:nth-child(even) {
            flex-direction: row-reverse;
        }

        table {
            border-spacing: 0 .5em;
            border-collapse: separate;
        }

        #admin1,
        #admin2,
        #admin3 {
            position: relative;
        }

        body {
            background-color: rgb(255, 255, 255) !important;
        }

        .form-control {
            background-color: #e9e9e9 !important;
            width: 450px !important;
            height: 40px !important;
            border: none !important;
            transition: ease .5s !important;
        }

        .form-control:focus {
            background-color: #eaeaea !important;
        }

        .form-control::placeholder {
            color: #888;
            font-size: 17px;
            transition: ease .5s;
        }

        .form-control:focus::placeholder {
            transition: ease .5s;
            color: rgb(115, 174, 197);
            font-size: 16px;
        }
        .table td{
            border: none;
        }
        tr{
            background-color: rgb(214, 235, 243);
        }
        .table-striped tbody tr:nth-of-type(odd){
            background-color: #f7f7f7;
        }
        body{
            background: none;
            
        }
    </style>
</head>

<body>
    <?php include "nav.php";?>
    <div class="container mt-3">
        <div class="container p-3 m-2" style="border :rgb(103, 148, 190) 1.5px solid ;">
            <div class="btn btn-change active" data-admin="admin1" onclick="showAdmin('admin1',this)">接駁車管理</div>
            <div class="btn btn-change" data-admin="admin2" onclick="showAdmin('admin2',this)">站點管理</div>
            <div class="btn btn-change" data-admin="admin3" onclick="showAdmin('admin3',this)">表單設定</div>
        </div>
        <div id="admin1" class="admin">
            <div class="d-flex" style="align-items: center;justify-content: center;">
                <h1 class="text-center hi m-0">接駁車管理</h1>
                <div class="btn btn-success ml-2" onclick="$('.modal.a1').fadeIn();">新增</div>
            </div>
            <div style="overflow: scroll;overflow-x: hidden;height: 700px;">
                <table id="bus" class="table table-striped mt-2 text-center">
                    <tr style="background-color: rgb(107, 152, 182);color: #fff;">
                        <td style="width: 25%;">編號</td>
                        <td style="width: 25%;">車牌</td>
                        <td style="width: 25%;">已行駛時間(分鐘)</td>
                        <td style="width: 25%;">操作</td>
                    </tr>
                    <?php include_once "./api/db.php";
                    $buses = $conn->query("select * from `bus`")->fetchAll(PDO::FETCH_ASSOC);
                        foreach($buses as $bus){
                            ?>
                    <tr>
                        <td>
                            <?=$bus['id']?>
                        </td>
                        <td>
                            <?=$bus['busName']?>
                        </td>
                        <td>
                            <?=$bus['minute']?>
                        </td>
                        <td>
                            <div class="btn btn-outline-secondary" onclick="edit('bus',<?=$bus['id']?>)">編輯</div>
                            <div class="btn btn-outline-danger" onclick="del('bus',<?=$bus['id']?>)">刪除</div>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
        <div id="admin2" style="display: none;" class="admin">
            <div class="d-flex" style="align-items: center;justify-content: center;">
                <h1 class="text-center hi m-0">站點管理</h1>
                <div class="btn btn-success ml-2" onclick="$('.modal.a2').fadeIn();">新增</div>
            </div>
            <div style="overflow: scroll;overflow-x: hidden;height: 700px;">
                <table id="station" class="table table-striped mt-2 text-center" onclick="setT('station')">
                    <thead>
                        <tr style="background-color: rgb(107, 152, 182);color: #fff;">
                            <td style="width: 4%;"></td>
                            <td style="width: 16%;">編號</td>
                            <td style="width: 20%;">站點名稱</td>
                            <td style="width: 20%;">行駛時間(分鐘)</td>
                            <td style="width: 20%;">停留時間(分鐘)</td>
                            <td style="width: 20%;">操作</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include_once "./api/db.php";
                        $stationes = $conn->query("select * from `station` order by `rank`")->fetchAll(PDO::FETCH_ASSOC);
                            foreach($stationes as $station){
                                ?>
                        <tr data-id="<?=$station['id']?>">
                            <td style="width: 4%;cursor: pointer;">&#9776;</td>
                            <td style="width: 16%;">
                                <?=$station['id']?>
                            </td>
                            <td style="width: 20%;" >
                                <?=$station['stationName']?>
                            </td>
                            <td style="width: 20%;">
                                <?=$station['minute']?>
                            </td>
                            <td style="width: 20%;">
                                <?=$station['waiting']?>
                            </td>
                            <td style="width: 20%;">
                                <div class="btn btn-outline-secondary" onclick="edit('station',<?=$station['id']?>)">編輯
                                </div>
                                <div class="btn btn-outline-danger" onclick="del('station',<?=$station['id']?>)">刪除</div>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="admin3" style="display: none;" class="admin">
            <h1 class="text-center hi mb-2">表單設定</h1>
            <div class="d-flex" style="align-items: center;justify-content: center;">
                <form action="./api/add_form.php" method="post" class="d-flex">
                    <input type="text" pattern="^[^@\s]+@[^@\s]+\.(com)$" name="email" id="email" required
                        class="form-control" placeholder="請設定參與者信箱" title="格式為XXX@XXX.com">
                    <input type="submit" class="btn btn-success ml-2" value="設定">
                </form>
                <div class="dropdown" style="position: absolute;left: 0;top: 50px;">
                    <button class="btn-lg btn-secondary dropdown-toggle" data-bs-toggle="dropdown">意願調查結果</button>
                    <div class="dropdown-menu">
                        <div style="cursor: pointer;" class="dropdown-item active" onclick="showTable('form',this)">意願調查結果</div>
                        <div style="cursor: pointer;" class="dropdown-item" onclick="showTable('list',this)">參與者名單</div>
                    </div>
                </div>
                <?php include "./api/db.php";
                $open = $conn->query("select `active` from `formopen` limit 1")->fetchColumn();
                $formes = $conn->query("select * from `form` where `checked`=1 AND `close`=1")->fetchAll(PDO::FETCH_ASSOC);
                $total = count($formes);
                $needBus = ceil($total / 50);
                ?>
                <div class="custom-comtrol custom-switch" style="position: absolute;left: 0;top: 100px;">
                    <input type="checkbox" name="customSwitch1" id="customSwitch1" value="<?=$open?>" class="custom-control-input">
                    <label for="customSwitch1" class="custom-control-label">是否開啟表單</label>
                </div>
                <div style="position: absolute;right: 0;top: 80px;">
                    <form action="./api/give_bus.php" method="post" style="display: flex;align-items: center;">
                        <input type="hidden" value="<?=$needBus?>" id="needBus" name="needBus">
                        <div style="font-weight: bolder;font-size: large;">目前需派遣<?=$needBus?>輛接駁車</div>
                        <input type="submit" value="分配接駁車" class="btn btn-outline-primary">
                    </form>
                </div>
            </div>
            <div class="mt-4" style="overflow: scroll;overflow-x: hidden;height: 700px;">
                <table id="form" class="table table-striped text-center">
                    <tr style="background-color: rgb(107, 152, 182);color: #fff;">
                        <td style="width: 25%;">編號</td>
                        <td style="width: 25%;">姓名</td>
                        <td style="width: 25%;">信箱</td>
                        <td style="width: 25%;">操作</td>
                    </tr>
                    <?php include_once "./api/db.php";
                        foreach($formes as $form){
                            ?>
                    <tr>
                        <td>
                            <?=$form['id']?>
                        </td>
                        <td>
                            <?=$form['name']?>
                        </td>
                        <td>
                            <?=$form['email']?>
                        </td>
                        <td>
                            <div class="btn btn-outline-secondary" onclick="edit('form',<?=$form['id']?>)">編輯</div>
                            <div class="btn btn-outline-danger" onclick="delF('form',<?=$form['id']?>)">刪除</div>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <table id="list" class="table table-striped mt-2 text-center" style="display: none;">
                    <tr style="background-color: rgb(107, 152, 182);color: #fff;">
                        <td style="width: 25%;">編號</td>
                        <td style="width: 25%;">信箱</td>
                        <td style="width: 25%;">分配車輛</td>
                        <td style="width: 25%;">是否回復意願</td>
                    </tr>
                    <?php include_once "./api/db.php";
                    $listes = $conn->query("select * from `form`")->fetchAll(PDO::FETCH_ASSOC);
                        foreach($listes as $list){
                            if($list['checked']=='1'){
                                $checked = "是";
                            }else{
                                $checked = "否";
                            }
                            ?>
                    <tr>
                        <td>
                            <?=$list['id']?>
                        </td>
                        <td>
                            <?=$list['email']?>
                        </td>
                        <td>
                            <?=$list['takeBus']?>
                        </td>
                        <td>
                            <?=$checked?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
        <div class="modal a1">
            <div style="display: flex;justify-content: center;align-items: center;position: relative;">
                <form action="./api/add_bus.php" method="post" class="form shadow">
                    <div style="color: #888;font-size: xxx-large;position: absolute;right: 730px;cursor: pointer;top: 10px;" onclick="$('.modal').fadeOut()">&times;</div>
                    <h1 class="text-center hi">新增接駁車</h1>
                    <label for="busName">車牌</label>
                    <input type="text" name="busName" id="busName" class="form-control form-group" placeholder="請輸入車牌" required>
                    <label for="add_busMin">已行駛時間(分鐘)</label>
                    <input type="number" name="add_busMin" id="add_busMin" class="form-control form-group" placeholder="請輸入已行駛時間(分鐘)" max="999" min="0" required>
                    <input type="submit" class="submitBtn" value="送出">
                </form>
            </div>
        </div>
        <div class="modal a2">
            <div style="display: flex;justify-content: center;align-items: center;position: relative;">
                <div style="color: #888;font-size: xxx-large;position: absolute;right: 730px;cursor: pointer;top: 10px;" onclick="$('.modal').fadeOut()">&times;</div>
                <form action="./api/add_station.php" method="post" class="form shadow">
                    <h1 class="text-center hi">新增站點</h1>
                    <label for="stationName">站點名稱</label>
                    <input type="text" name="stationName" id="stationName" class="form-control form-group" placeholder="請輸入站點名稱" required>
                    <label for="add_stationMin">行駛時間(分鐘)</label>
                    <input type="number" name="add_stationMin" id="add_stationMin" class="form-control form-group" placeholder="請輸入行駛時間(分鐘)" max="999" min="0" required>
                    <label for="waiting">停留時間(分鐘)</label>
                    <input type="number" name="waiting" id="waiting" class="form-control form-group" placeholder="請輸入停留時間(分鐘)" max="999" min="0" required>
                    <input type="submit" class="submitBtn" value="送出">
                </form>
            </div>
        </div>
        <div class="modal e1">
            <div style="display: flex;justify-content: center;align-items: center;position: relative;">
                <div style="color: #888;font-size: xxx-large;position: absolute;right: 730px;cursor: pointer;top: 10px;" onclick="$('.modal').fadeOut()">&times;</div>
                <form action="./api/edit_bus.php" method="post" class="form shadow">
                    <h2 class="text-center hi">修改「 <span id="edit_busName"></span> 」接駁車</h2>
                    <input type="hidden" id="edit_busId" name="edit_busId">
                    <label for="edit_busMin">已行駛時間(分鐘)</label>
                    <input type="number" name="edit_busMin" id="edit_busMin" class="form-control form-group" placeholder="請輸入已行駛時間(分鐘)" max="999" min="0" required>
                    <input type="submit" class="submitBtn" value="送出">
                </form>
            </div>
        </div>
        <div class="modal e2">
            <div style="display: flex;justify-content: center;align-items: center;position: relative;">
                <div style="color: #888;font-size: xxx-large;position: absolute;right: 730px;cursor: pointer;top: 10px;" onclick="$('.modal').fadeOut()">&times;</div>
                <form action="./api/edit_station.php" method="post" class="form shadow">
                    <input type="hidden" id="edit_stationId" name="edit_stationId">
                    <h2 class="text-center hi">修改「 <span id="edit_stationName"></span> 」站點</h2>
                    <label for="edit_stationMin">行駛時間(分鐘)</label>
                    <input type="number" name="edit_stationMin" id="edit_stationMin" class="form-control form-group" placeholder="請輸入行駛時間(分鐘)" max="999" min="0" required>
                    <label for="edit_waiting">停留時間(分鐘)</label>
                    <input type="number" name="edit_waiting" id="edit_waiting" class="form-control form-group" placeholder="請輸入停留時間(分鐘)" max="999" min="0" required>
                    <input type="submit" class="submitBtn" value="送出">
                </form>
            </div>
        </div>
        <div class="modal e3">
            <div style="display: flex;justify-content: center;align-items: center;position: relative;">
                <div style="color: #888;font-size: xxx-large;position: absolute;right: 730px;cursor: pointer;top: 10px;" onclick="$('.modal').fadeOut()">&times;</div>
                <form action="./api/edit_form.php" method="post" class="form shadow">
                    <input type="hidden" id="edit_formId" name="edit_formId">
                    <h1 class="text-center hi">修改「 <span id="edit_email"></span> 」</h1>
                    <label for="edit_name">姓名</label>
                    <input type="text" name="edit_name" id="edit_name" class="form-control form-group" placeholder="請輸入姓名"required>
                    <input type="submit" class="submitBtn" value="送出">
                </form>
            </div>
        </div>
    </div>
</body>
<script src="./js/jquery.js"></script>
<script src="./js/jquery-ui.min.js"></script>
<script src="./bs/bootstrap.js"></script>
<script src="./bs/bootstrap.bundle.min.js"></script>
<script src="./admin.js"></script>
<script>
    function showAdmin(item, btn) {
        $(".admin").hide();
        $("#" + item).fadeIn();
        $(".btn-change").removeClass('active');
        $(btn).addClass('active');
        localStorage.setItem('getP', item);
    }
    $(document).ready(function(){
    var getP = localStorage.getItem('getP');
        $(".admin").hide();
        $("#" + getP).fadeIn();
        $(".btn-change").removeClass('active');
        $(".btn-change[data-admin='" + getP + "']").addClass('active');
    })

    function showTable(table, btn) {
        $("#form").hide();
        $("#list").hide();
        $("#" + table).fadeIn();
        $(".dropdown-item").removeClass('active');
        $(btn).addClass('active');
        let a = $(btn).text();
        $(".dropdown-toggle").text(a);
    }
    $(document).ready(function(){
        let acrive = $("#customSwitch1").val();
        if(acrive==1){
            $("#customSwitch1").attr('checked',true);
        }else{
            $("#customSwitch1").attr('checked',false);
        }
    })
    $(document).ready(function(){
        $("#customSwitch1").on('input',function(){
            var acrive = $("#customSwitch1").is(":checked");
            if(acrive==true){
                let active = 1;
                $.post("./api/editOpen.php",{active:active},()=>{

                })
            }else{
                let active = 0;
                $.post("./api/editOpen.php",{active:active},()=>{
                    
                })
            }
        })
    })
</script>

</html>