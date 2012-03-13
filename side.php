<?
session_start();
require_once("mysql-connect.php");
check();
?>
<div class="side">
<body class="side">
<head><b><h2  class="side">Menu</h2></b></head>
<link rel="stylesheet" type="text/css" href="style.css" />
<p  class="side"><a href="article.php" target="main">簡章</a></p>
<p  class="side"><a href="map.pdf" target="main">地圖</a></p>
<p  class="side"><a href="car_14th.pdf" target="main">停車車證</a></p>
<p  class="side"><a href="school.php" target="main" >學校基本資訊</a></p>
<p  class="side"><a href="apply.php" target="main">選手報名</a></p>
<p  class="side"><a href="view.php" target="main">檢視報名資訊</a></p>
<p  class="side"><a href="relayapply.php" target="main">報名接力</a></p>
<p  class="side"><a href="towel.php" target="main">購買大毛巾</a></p>
<p  class="side"><a href="building.php" target="main">贊助商</a></p>
<?
    if(admin()==1){
        echo "<p class='side'><a href='manage.php' target='main'>管理介面</a></p>";
    }
?>
<p class="side"><a href="index.php" target="_top">登出</a></p>
</body>
</div>
