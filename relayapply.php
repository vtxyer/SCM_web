<?
session_start();
include("mysql-connect.php");
check();
deadline();
$id=$_SESSION['id'];

    if(isset($_POST['button'])){
       $id=$_SESSION['id'];
       if($_POST['myn1']==1)
           mysql_query("update `school` set `mrelayim`='1' where `id`='$id'");
       elseif($_POST['myn1']==2)
           mysql_query("update `school` set `mrelayim`='0' where `id`='$id'");

       if($_POST['myn2']==1)
           mysql_query("update school set mrelay=1 where id='$id'");
       elseif($_POST['myn2']==2)
           mysql_query("update school set mrelay=0 where id='$id'");

       if($_POST['wyn1']==1)
           mysql_query("update school set wrelayim=1 where id='$id'");
       elseif($_POST['wyn1']==2)
           mysql_query("update school set wrelayim=0 where id='$id'");

       if($_POST['wyn2']==1)
           mysql_query("update school set wrelay=1 where id='$id'");
       elseif($_POST['wyn2']==2)
           mysql_query("update school set wrelay=0 where id='$id'");
    }
    $r=mysql_fetch_row(mysql_query("select mrelay,wrelay,mrelayim,wrelayim from school where id=$id"));

?>

<p align="center"><th><strong>是否報名接力</th><br/><br/></p>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<div align="center">
<form action="#" method="post">
<th>男子400混和式接力(現在報名情況:
<?
    if($r[2]==1)
        echo "報名";
    else
        echo "未報名";    
?>
 )</th>
<input type="RADIO" name="myn1" value="1">是
<input type="RADIO" name="myn1" value="2">否<br/>
<th>男子400自由式接力(現在報名情況:
<?
    if($r[0]==1)
        echo "報名";
    else
        echo "未報名";    
?>
 )</th>
<input type="RADIO" name="myn2" value="1">是
<input type="RADIO" name="myn2" value="2">否<br/>
<th>女子400混和式接力(現在報名情況:
<?
    if($r[3]==1)
        echo "報名";
    else
        echo "未報名";    
?>
 )</th>
<input type="RADIO" name="wyn1" value="1">是
<input type="RADIO" name="wyn1" value="2">否<br/>
<th>女子400自由式接力(現在報名情況:
<?
    if($r[1]==1)
        echo "報名";
    else
        echo "未報名";    
?>
 )</th>
<input type="RADIO" name="wyn2" value="1">是
<input type="RADIO" name="wyn2" value="2">否<br/>

<input type="SUBMIT" name="button" value="確認">
</form>
<div>


