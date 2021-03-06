<?php


ini_set('display_errors',1);

# MySQLに接続
$mysqli = new mysqli("localhost", "root", "poi", "poipet");

# 接続状況をチェック
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$mysqli->query('SET NAMES utf8'); // 日本語設定

#
$poipets = [];
$result1 = $mysqli->query("SELECT * from poipets");
while($row = $result1->fetch_assoc()){
    $id = $row['poipet_id'];
    $locate = $row['locate'];
    
    $poipetLocate[$id] = $locate;
    $result2 = $mysqli->query("SELECT count(*) as 'c' from pois where poipet_id = $id and collect = 0");
    $row = $result2->fetch_assoc();
    $poipetCount[$id] = $row['c'];
}


?>

<!DOCTYPE html>
<html lang="en">
           <head>
           <meta charset="utf-8" />

           <title>PoiPet map list</title>
           <meta name="description" content="">
           <meta name="author" content="">
           <meta name="HandheldFriendly" content="true">
           <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
           <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
           <link rel="stylesheet" href="map_css/main.css">
           <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
           <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC2ny8M38_vGWpc_jPTRIF_6HUvGww6v0U&sensor=true"></script>
           <!-- // <script type="text.javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
           <script src="js/jquery.min.js"></script>
           <script type="text/javascript" src="js/map.js"></script>
           <!-- // <script src="js/jquery.easing.min.js"></script>
           // <script src="js/jquery.scrollto.min.js"></script>
           // <script src="js/slabtext.min.js"></script>
           // <script src="js/jquery.nav.js"></script>
           // <script src="js/main.js"></script> -->
           </head>
           <body class="home color">
           <div id="header">
           <div class="container">

           <div class="row">

           <i id="nav-button" class="icon-circle-arrow-down"></i>
           <h2 id="logo"><a href="http://poipet.ml/"><img src="img/poipet_logo2.png"></a></h2>

           </div>
           </div>
           </div>
           <!-- End Header -->

           <!-- Map list Section -->
           <div class="section" id="contact" >
           <div class="container">
           <div class="content">
           <div class="row">
           <div class="span12">
           <div class="title">
           <h2>Map List</h2>
           <div class="hr hr-small hr-center"><span class="hr-inner"></span></div>
           <p>Check capacity of each PoiPet</p>

           </div>
           </div>
           <div class="span8">
           <!-- <iframe width="100%" height="317" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=mRova+Solutions,+Pune,+Maharashtra&amp;aq=0&amp;oq=mrova&amp;sll=18.815427,76.775144&amp;sspn=14.731137,19.577637&amp;ie=UTF8&amp;hq=mRova+Solutions,&amp;hnear=Pune,+Maharashtra&amp;t=m&amp;ll=18.526817,73.903141&amp;spn=0.073244,0.132008&amp;z=13&amp;iwloc=A&amp;output=embed"></iframe> -->
           <!-- <iframe width="100%" height="317" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12964.848761265188!2d139.6956807287036!3d35.671776902439845!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x34bcc78ce7f8bf3e!2sYoyogi+Park!5e0!3m2!1sen!2sus!4v1447645972829"></iframe> -->
           <body onload="initialize();">
           <div id="map_canvas" style="width:100%;height:500px;"></div>
           </body>
           </div>
           <div class="span4">
           <div id="span4-left">
           <img src="img/s_box80-100.png">
           </div>
           <div id="span4-right">
           <h4><a href="#" data-id=0>総合研究棟B</a><max>もうすぐ回収！</max></h4>
           <p>現在のペットボトル本数：42本<br />最終回収日時：11/17 16:30</p>
                                                                        </div>
                                                                        <hr class="grey"/>
                                                                        <div id="span4-left">
                                                                        <img src="img/s_box0-20.png">
                                                                        </div>
                                                                        <div id="span4-right">
                                                                        <h4><a href="#" data-id=1>ゆかりの森</a></h4>
                                                                        <p>現在のペットボトル本数：3本<br />最終回収日時：11/18 15:48</p>
                                                                                                                                    </div>
                                                                                                                                    <hr class="grey"/>
                                                                                                                                    <div id="span4-left">
                                                                                                                                    <img src="img/s_box20-40.png">
                                                                                                                                    </div>
                                                                                                                                    <div id="span4-right">
                                                                                                                                    <h4><a href="#" data-id=2>つくばエキスポセンター</a></h4>
                                                                                                                                    <p>現在のペットボトル本数：12本<br />最終回収日時：11/18 12:23</p>
                                                                                                                                                                                                 </div>
                                                                                                                                                                                                 <div id="span4-button">
                                                                                                                                                                                                 <input type="button" onclick="location.href='http://poipet.ml'"value="PoiPet新規追加">
                                                                                                                                                                                                 </div>
                                                                                                                                                                                                 </div>
                                                                                                                                                                                                 </div>
                                                                                                                                                                                                 </div>
                                                                                                                                                                                                 </div>

                                                                                                                                                                                                 </div>
                                                                                                                                                                                                 <!-- End Contact Section -->
                                                                                                                                                                                                 <div id="footer">
                                                                                                                                                                                                 &copy; 2015 Developed by SAWARITAI</a>.
                                                                                                                                                                                                     </div>

</body>
</html>