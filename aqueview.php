<?
session_start();
include("mysql-connect.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>水道</title>
<?
    $item=$_SESSION['item'];
    $sex=$_SESSION['sex'];
/////////////////////////////////////////    
//    $item="50free";
//    $sex="male";
/////////////////////////////////////////
    echo "<p align='center'><font size=30><strong>$item</strong></font></p>";
    $itemname=$item.$sex;
//    echo "<br/>$itemname<br/>";
        $max_class=mysql_fetch_row(mysql_query("select max(class) from `$itemname`"));
        $max_class=$max_class[0];
        for($i=1;$i<=$max_class;$i++){
        ?>
        <div align="center">
        <table width="500" height="38" border="1">
        <tr>
        <th width="250" scope="col"><strong>姓名</th>
        <th width="100" scope="col"><strong>學校</th>
        <th width="50" scope="col"><strong>水道</th>
        <th width="50" scope="col"><strong>組別</th>
        <th width="50" scope="col"><strong>類別</th>        
        <th width="50" scope="col"><strong>秒數</th>
        </tr><br/><br/>
        <?  
            $itemname=$item.$sex;      
            $q=mysql_query("select * from `$itemname`                    
                         where `class`='$i'
                    ");
            while($r=mysql_fetch_row($q)){
               echo "<tr>
                   <td width='100' scope='col'><strong>$r[0]</td>
                   <td width='150' scope='col'><strong>$r[1]</td>
                   <td width='50' scope='col'><strong>$r[2]</td>
                   <td width='50' scope='col'><strong>$r[3]</td>
                   <td width='50' scope='col'><strong>$r[5]</td>
                   <td width='50' scope='col'><strong>$r[4]</td>
                   </tr>";
            }
            echo "<table>";
        }


?>
