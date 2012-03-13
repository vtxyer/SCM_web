<?
session_start();
include("mysql-connect.php");
check();
deadline();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<head>
<title>接力報名資訊</title>
</head>
</br></br></br></br></br></br>
<?
$item=array("mrelay","wrelay","mrelayim","wrelayim");
$citem=array("男子四百公尺自由式接力","女子子四百公尺自由式接力","男子四百公尺混合式接力","女子子四百公尺混合式接力");
$ary=array();
array_push($ary,mysql_query("select sname from school where mrelay=1"));
array_push($ary,mysql_query("select sname from school where wrelay=1"));
array_push($ary,mysql_query("select sname from school where mrelayim=1"));
array_push($ary,mysql_query("select sname from school where wrelayim=1"));
for($i=0; $i<sizeof($ary); $i++){
    echo "
    <div align='center'>
    <table width='1200' height='38' border='2'>
    <tr>
        <th colspan=2><strong>$citem[$i]</th>
    </tr>
    ";
    $sum=0;
    while(($q=mysql_fetch_row($ary[$i]))){
        $sum++;
        echo"
        <tr>
        <td align=center width='20%'>校名</td>
        <td align=center  width='80%'>$q[0]</td>
        </tr> 
        ";
    }
    echo "
        <th colspan=2>共有 $sum 隊</th>
        </table></div><br/><br/><br/>
        ";
}
?>
