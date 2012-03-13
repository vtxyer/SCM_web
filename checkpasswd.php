<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
include("mysql-connect.php");
$at=$_POST['at'];
$pw=$_POST['pw'];
//echo $_POST['at'];
//echo "$id   $pw\n";


$sql="SELECT *
      FROM `school`
      where `account`='$at'
";

$result=mysql_query($sql);
$row=@mysql_fetch_row($result);

if($at!=NULL && $pw!=NULL && $row[1]==$at && $row[2]==sha1($pw))
{
    $_SESSION['id']=$row[0];
    echo'登入成功';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=main.php>';
}
else
{
    echo'NO';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}


?>

