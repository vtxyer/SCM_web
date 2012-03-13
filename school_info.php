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


<?
$id=$_SESSION['id'];
$ary_id=array($id);

if($_SESSION['tid']!=0){
    $ary_id=array($_SESSION['tid']);
    $_SESSION['tid']=0;
}
elseif(admin()&&$_SESSION['all']==1){
    $ary_id=showschool();
    $_SESSION['all']=0;
}

foreach($ary_id as $id){

    $ary_val=array($_POST['leader'],$_POST['coach'],$_POST['email'],$_POST['phone']); 

    if(isset($_POST['button99'])){
        foreach($ary_val as $q){
            str_replace("\'","",$q);
        }
        if(preg_match("/[^(\w|\d|\.|\@|\_|\=|\-)]+/",$_POST['email'])){
            echo "<div class=error>email有不合法字元</div>";
        }
        if(preg_match("/[^(\d)]+/",$_POST['phone'])){
            echo "<div class=error>連絡電話只允許輸入數字</div>";            
        }
        else{
            $query="update `school` set
                    `leader`='$ary_val[0]',
                    `coach`='$ary_val[1]',
                    `email`='$ary_val[2]',
                    `phone`='$ary_val[3]'
                    where `id`='$id'
                ";
            if(!mysql_query($query)){
            }
            echo "修改完成<br/>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=school.php>';            
        }
    }

?>
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
echo "<br>".$id."<br/>";

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
            <form action="#" method="post">
            <tr>
            <td><?echo $row[1];?><input type="HIDDEN" name="nid" value=<?echo $row[0];?>></td>
            <td><?echo $row[3];?></td>
            <td><input type="text" name="leader" value=<?echo $row[4];?>></td>
            <td><input type="text" name="coach" value=<?echo $row[5];?>></td>
            <td><input type="text" name="email" value=<?echo $row[6];?>></td>
            <td><input type="text" name="phone" value=<?echo $row[7];?>></td>
            <td><input type="submit" name="button99" id="button" value="修改" /></td>
            </tr>
            </form>
        <?
    }

}
?>
</body>
