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
        /* body{
            background:#fff !important ;
        } */
        .longStr{
            width: 300px;
            height: 30px;
            background-color: #6db5e1;
            position: relative;
        }
        tr:nth-child(even){
            flex-direction: row-reverse;
        }
        tr{
            display: flex;
            margin: 50px;
        }
        td{
            padding: 0 !important;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .point{
            position: absolute;
            width: 60px;
            height: 60px;
            transition: ease 0.2s;
        }
        .point:hover{
            transform: scale(1.07);
            transition: ease 0.3s;
        }
        p{
            position: absolute;
            z-index: 998;
        }
        tr:first-child{
            justify-content: flex-end;
        }
        .show3{
            padding: 5px;
            position: absolute;
            bottom: 80px;
            font-family: Arial, sans-serif;
            z-index: 999;
            border-radius: 10px 15px;
            text-align: center;
            width: 150px;
            animation: show ease 0.5s;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .shortStrUp{
            background-color: #6db5e1;
            width: 30px;
            height: 100px;
            position: relative;
            bottom: 35px;
        }
        .shortStrDown{
            background-color: #6db5e1;
            width: 30px;
            height: 100px;
            position: relative;
            top: 35px;
        }
        @keyframes show {
            from{transform: translateY(15px);}
        }
        table{
            background-color: #ffffffba;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <?php include "nav.php";
    include "./api/db.php";
    $stations = $conn->query("select * from `station` order by `rank` ASC")->fetchAll(PDO::FETCH_ASSOC);
    $total = count($stations);
    $total3 = ceil($total / 3);
    ?>
    <div style="display: flex;justify-content: center;align-items: center;">
        <table class="shadow mt-5">
            <?php for($i=0;$i<$total3;$i++){
                ?>
                <tr>
                    <?php 
                      for($j=0;$j<3;$j++){
                          $index = $i * 3 + $j;
                          if($index >= $total){
                              break;
                          }
                          $station = $stations[$index];
                          $prev = $conn->query("select sum(`waiting`+`minute`) from `station` where `rank`< '{$station['rank']}'")->fetchColumn();
                          $arrive = $prev +$station['minute'];
                          $leave = $arrive +$station['waiting'];
                          $bus = $conn->query("select * from `bus` where `minute` <= $leave order by `minute` DESC")->fetch(PDO::FETCH_ASSOC);
                          if($bus){
                              $station['busName'] = ($bus['minute']< $arrive) ? $bus['busName'] : "<span style='color:red'>" . $bus['busName'] . "</span>";
                              $station['time'] = ($bus['minute']< $arrive) ? "約" . ($arrive-$bus['minute']) . "分鐘": "<span style='color:red'>已到站</span>";
                            }else{
                            $station['busName']='';
                            $station['time']="<span style='color:#888'>未發車</span>";
                           }
                      $buses=$conn->query("select * from `bus` where `minute` <= $leave order by `minute` DESC limit 3")->fetchAll(PDO::FETCH_ASSOC);
                      if(count($buses) < 3 ){
                          $addBus = $conn->query("select `busName`,`minute` from `bus` where `minute` > $leave limit " . (3-count($buses)))->fetchAll(PDO::FETCH_ASSOC);
                          $buses = array_merge($addBus,$buses);
                        }
                        $busInfo = [];
                        foreach($buses as $bus){
                            $info = [];
                            if($bus['minute']<=$leave){
                                $info['busName'] = ($bus['minute']< $arrive) ? $bus['busName'] : "<span style='color:red'>" . $bus['busName'] . "</span>";
                                $info['time'] = ($bus['minute']< $arrive) ? "約" . ($arrive-$bus['minute']) . "分鐘": "<span style='color:red'>已到站</span>";
                            }else{
                                $info['busName']=$bus['busName'];
                                $info['time']="<span style='color:#888'>未發車</span>";
                            }
                            $busInfo[]=$info;
                        }
                        ob_start();
                        foreach($busInfo as $info){
                          echo "<span>{$info['busName']} {$info['time']}<br></span>";
                        }
                        $station['bus_html']=ob_get_clean();
                        ?>
                        <td>
                            <p style="margin-bottom: 135px;font-weight: bold;"><?=$station['busName']?></p>
                            <p style="margin-bottom: 85px;"><?=$station['time']?></p>
                            <div class="longStr"></div>
                            <img src="./img/POINT.png" alt="" class="point" onmousemove="show(<?=$station['id']?>)" onmouseout="by(<?=$station['id']?>)">
                            <div class="show3" style="display: none;" id="hi_<?=$station['id']?>"><?=$station['bus_html']?></div>
                            <p style="margin-top: 105px;font-weight: bold;"><?=$station['stationName']?></p>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }  
            ?>
        </table>
    </div>
    <div style="justify-content: flex-start;"></div>
</body>
<script src="./js/jquery.js"></script>
<script src="./bs/bootstrap.js"></script>
<script src="./bs/bootstrap.bundle.min.js"></script>
<script>
    function show(id){
        $("#hi_"+id).fadeIn('fast');
    }
    function by(id){
        $("#hi_"+id).fadeOut('fast');
    }
    $(document).ready(function(){
        $("tr:first-child>td:first-child").css({
            'justify-content': 'flex-start',
        })
        $("tr:first-child>td:first-child>div.longStr").css({
            'width': '180px',
            'border-radius':'20px 0 0 20px',
        })
        $("tr:first-child>td:first-child>div.show3").css({
            'right': '80px',
        })
    })
    $(document).ready(function(){
        var a = $("tr:last-child").index();
        if(a % 2==0){
            $("tr:last-child>td:last-child").css({
                'justify-content': 'flex-end',
            })
            $("tr:last-child>td:last-child>div.longStr").css({
                'width': '180px',
                'border-radius':'0 20px 20px 0px',
            })
            $("tr:last-child>td:last-child>div.show3").css({
            'left': '80px',
        })
        }else{
            $("tr:last-child>td:last-child").css({
                'justify-content': 'flex-start',
            })
            $("tr:last-child>td:last-child>div.longStr").css({
                'width': '180px',
                'border-radius':'20px 0 0 20px',
            })
            $("tr:last-child>td:last-child>div.show3").css({
            'right': '80px',
        })
        }
    })
    $(document).ready(function(){
        let html = "<div class='shortStrDown'></div>";
        let html1 = document.createElement('put');
        let $html = $(html);
        let $html1 = $(html1);
        $("tr:nth-child(odd):not(:last-child)>td:last-child").after($html).after($html1);
    })
    $(document).ready(function(){
        let html = "<div class='shortStrDown'></div>";
        let html1 = document.createElement('put');
        let $html = $(html);
        let $html1 = $(html1);
        $("tr:nth-child(even):not(:last-child)>td:last-child").after($html).after($html1);
    })
    $(document).ready(function(){
        let html = "<div class='shortStrUp'></div>";
        let html1 = document.createElement('put');
        let $html = $(html);
        let $html1 = $(html1);
        $("tr:nth-child(odd):not(:first-child)>td:first-child").before($html).before($html1);
    })
    $(document).ready(function(){
        let html = "<div class='shortStrUp'></div>";
        let html1 = document.createElement('put');
        let $html = $(html);
        let $html1 = $(html1);
        $("tr:nth-child(even)>td:first-child").before($html).before($html1);
    })
</script>
</html>