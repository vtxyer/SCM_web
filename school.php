<?
session_start();
include("mysql-connect.php");
check();
deadline();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<head>
<title>學校資訊</title>
</head>
<br><br><br><br><br><br><br><br>
<body>
<div align="center">
<table width="1200" height="38" border="1">
<tr>
<th width="197" scope="col"><strong>帳號</th>
<th width="197" scope="col"><strong>校名</th>
<th width="197" scope="col"><strong>隊長</th>
<th width="197" scope="col"><strong>教練</th>
<th width="200" scope="col"><strong>聯絡email</th>
<th width="144" scope="col"><strong>連絡電話</th>
</tr> 
</div>

<?
    $id=$_SESSION['id'];

    $ary_val=array($_POST['sname'],$_POST['leader'],$_POST['coach'],$_POST['email'],$_POST['phone']); 

    $query=
        "
        SELECT *
        FROM `school`
        WHERE `id`='$id'
        ";
    $result=mysql_query($query);
    while($row=mysql_fetch_row($result))
    {
        ?>
            <form action="school_info.php" method="post">
            <tr>
            <td><?echo $row[1];?><input type="HIDDEN" name="nid" value=<?echo $row[0];?>></td>
            <td><?echo $row[3];?></td>
            <td><?echo $row[4];?></td>
            <td><?echo $row[5];?></td>
            <td><?echo $row[6];?></td>
            <td><?echo $row[7];?></td>
            <td><input type="submit" name="button1" id="button" value="修改" /></td>            
            </form>
            <form action="chpasswd.php">
            <td><input type="submit" value="更改密碼"></td>
            </form>
            </tr>
        <?
    }

?>
</body>
