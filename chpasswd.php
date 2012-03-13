<?
session_start();
include("mysql-connect.php");
check();
?>


<?
    $id=$_SESSION['id'];
    if(isset($_POST['btn'])){
        $newp=$_POST['newp'];
        $newp2=$_POST['newp2'];
        $oldp=$_POST['oldp'];
        if(preg_match("/[^(\w|\d)]+/",$_POST['newp']) )
            echo "<div class=error>含有不合法字元，請重新輸入</div>"; 
        else{
            if($newp!=$newp2){
                echo "<div class=error>重複新密碼輸入錯誤</div>";
            }
            else{
                $o=mysql_fetch_row(mysql_query("select passwd from school where id='$id'"));
                if(sha1($oldp)!=$o[0]){
                    echo "<div class=error>舊密碼輸入錯誤</div>";
                }
                else{
                    $new=sha1($newp);
                    mysql_query("update school set passwd='$new' where id='$id'");
                    echo "修改成功";
                }
            }
        }        
    }

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<head>
<title>更改密碼</title>
</head>
<br><br><br><br>
<body>
<div align="center">
<form action="#" method="post">
<table  height="30%" border="0">
<tr>
<td><strong>新密碼</td>
<td><input type="password" name=newp></td>
</tr>
<tr>
<td><strong>重複新密碼</td>
<td><input type="password" name=newp2></td>
</tr>
<tr>
<td><strong>舊密碼</td>
<td><input type="password" name=oldp></td>
</tr>
<tr>
<td colspan=2 align="center">(只允許含有英文大小寫以及數字)</td>
</tr>
<tr>
<td colspan=2 align="center"><input type="submit" name="btn" value="確認"></td>
</tr>
</table>
</form>
</div>

</body>
