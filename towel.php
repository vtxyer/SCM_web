<?
session_start();
include("mysql-connect.php");
check();
deadline();

$id=$_SESSION['id'];

if(isset($_POST['buttons'])){
    $num=$_POST['towel_num'];
    mysql_query("update school set towel='$num' where id='$id'");
}
?>

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>大浴巾</title>
</head>
<body align="center">


<form method="post" action="#">
<table border=1 align="center">
<tr><td>樣式</td><td colspan=2 ><img src="towel.jpg" align="center"></td></tr>
<tr>
    <td>現已購買數量</td>
    <td colspan=2 align=center><b>
    <?
        $r=mysql_fetch_row(mysql_query("select towel from school where id='$id'"));
        echo "$r[0]";
    ?>
    </b></td>
</tr>
<tr>
    <td>欲購買數量<td>
    <select name="towel_num" align=center> 
        <?
        for($b1=0;$b1<=100;$b1++)
        {
                echo "<option value=$b1>$b1</option>";
        }
        ?> 
        </select>
    
    <td align=center><input type="submit" name="buttons" id="button" value="確認" /></td>
</tr>  
<table>    
</form>
</body>
