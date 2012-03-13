<?
session_start();
include("mysql-connect.php");
check();
deadline();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<head>
<title>報名資訊</title>
</head>
</br></br></br></br></br></br>
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
    
    if(isset($_POST['button1'])){
        $_SESSION['tid']=$_POST['tid'];
        $_SESSION['dnid']=$_POST['nid'];        
        $_SESSION['fromChange']=1;
        echo "<meta http-equiv=REFRESH CONTENT=0;url=apply.php>";
    }

    if(isset($_POST['button2'])){
        $nid=$_POST['nid']; 
        $ii=$_POST['image'];
        $dquery="
            DELETE FROM `athlete`
            WHERE `nid`='$nid'
            ";
        exec("test SCMphotoSe/$ii && rm -fr SCMphotoSe/$ii");
        if(mysql_query($dquery))echo '刪除成功';
    }

    $query=
        "
        SELECT *
        FROM `athlete`
        WHERE `id`='$id'
        ";
    $result=mysql_query($query);

?>
    <body>
<div align="center">
<table width="1200" height="38" border="1">
<tr>
<th width="197" scope="col"><strong>照片</th>
<th width="197" scope="col"><strong>姓名</th>
<th width="200" scope="col"><strong>身分證</th>
<th width="197" scope="col"><strong>監護人</th>
<th width="197" scope="col"><strong>生日</th>
<th width="197" scope="col"><strong>組別</th>
<th width="200" scope="col"><strong>報名項目(一)</th>
<th width="144" scope="col"><strong>時間(一)</th>
<th width="200" scope="col"><strong>報名項目(二)</th>
<th width="142" scope="col"><strong>時間(二)</th>
</tr> 
</div>
<?
    echo "<br/><br/><font size=5><b>$id</b></font><br/>";
    while($row=mysql_fetch_row($result))
    {
        $image="SCMphotoSe/$row[15]";
        ?>
            <form action="#" method="post">
            <tr>
            <td><img src=<?echo $image;?>><input type="HIDDEN" name="image" value=<?echo $row[15];?>></td>
            <td><?echo $row[1];?><input type="HIDDEN" name="nid" value=<?echo $row[2];?>><input type="HIDDEN" name="tid" value=<?echo $row[0];?>></td>
            <td><?echo $row[2];?></td>
            <td><?echo $row[4];?></td>
            <td><?echo "$row[3]";?></td>
            <td><?
                    if($row[5]=='B'){
                        echo "乙";
                    }
                    else
                        echo "甲";
                ?></td>
            <td><?echo "$row[6]";?></td>
            <td><?echo "$row[7]:$row[8].$row[9]";?></td>
            <td><?echo $row[10];?></td>
            <td><?
                    if(preg_match("/\d/",$row[10])){                        
                        echo "$row[11]:$row[12].$row[13]";
                    }
                ?></td>
            <td><input type="submit" name="button1" id="button" value="修改" /></td>
            <td><input type="submit" name="button2" value="刪除"></td>
            </tr>
            </form>
        <?
    }
}
?>
</body>
