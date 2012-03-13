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
<?
$q=mysql_query("select sname,towel from school");
while(($r=mysql_fetch_row($q))){
echo"
<tr>
    <td width=300>$r[0]</td>
    <td width=200>現已購買數量</td>
    <td colspan=2 align=center><b>$r[1]</b></td>
</tr>
";
}
?>
<table>    
</form>
</body>
