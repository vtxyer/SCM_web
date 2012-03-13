<?
session_start();
include("mysql-connect.php");
if(admin()==0){
    echo "error";
    exit;
}

if(isset($_POST['schoolbnt'])){
    $_SESSION['all']=1;  
    $_SESSION['tid']=$_POST['schoolbtnsel']; 
    echo '<meta http-equiv=REFRESH CONTENT=0;url=school_info.php>'; 
}
elseif(isset($_POST['viewbnt'])){    
    $_SESSION['all']=1;  
    $_SESSION['tid']=$_POST['viewbtnsel']; 
    echo '<meta http-equiv=REFRESH CONTENT=0;url=view.php>'; 
}
elseif(isset($_POST['relayviewbtn'])){
    echo '<meta http-equiv=REFRESH CONTENT=0;url=relayview.php>';
}
elseif(isset($_POST['towelviewbtn'])){
    echo '<meta http-equiv=REFRESH CONTENT=0;url=towelview.php>';
}
elseif(isset($_POST['aqueviewbnt'])){
    $a=split("-",$_POST['aqueviewbtnsel']);
    $_SESSION['item']=$a[1];
    $_SESSION['sex']=$a[0];
    echo '<meta http-equiv=REFRESH CONTENT=0;url=aqueview.php>';
}
elseif(isset($_POST['aquebnt'])){
    $a=split("-",$_POST['aquebtnsel']);
    $_SESSION['item']=$a[1];
    $_SESSION['sex']=$a[0];
    echo '<meta http-equiv=REFRESH CONTENT=0;url=aque.php>';
}
elseif(isset($_POST['stopbnt'])){
    mysql_query("update `manage` set deadline='$_POST[stopsel]'"); 
}
?>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理員</title>
<div align="center" >
<form action="#" method="post">
<table border=0 height="60%" >
    <tr>
        <td>查詢各校資料</td>
        <td><select name=schoolbtnsel>
                <option value="all">all</option>
                <?
                    $ary=showschool();
                    foreach($ary as $i){
                        $z=split("-",$i);
                        echo "<option value='$z[0]'>$z[1]</option>";                        
                    }
                ?>
            </select>
        <td>
        <td><input type="submit" name="schoolbnt" value="click"><td>
    </tr>
    <tr>
        <td>查詢報名資料</td>
        <td><select name=viewbtnsel>
                <option value="all">all</option>
                <?
                    $ary=showschool();
                    foreach($ary as $i){
                        $z=split("-",$i);
                        echo "<option value='$z[0]'>$z[1]</option>";                        
                    }
                ?>
            </select>
        <td>
        <td><input type="submit" name="viewbnt" value="click"><td>
    </tr>
    <tr>
        <td>查詢接力報名狀況</td>
        <td><select name=relayviewsel>
                <option value="all">all</option>
            </select>
        <td>
        <td><input type="submit" name="relayviewbtn" value="click"><td>
    </tr>

    <tr>
        <td>查詢道次表</td>
        <td><select name=aqueviewbtnsel>
                <?
                    $ary=showitem();
                    foreach($ary as $i){
                        echo "<option value='male-$i'>male $i</option>";
                    }
                    foreach($ary as $i){
                        echo "<option value='female-$i'>female $i</option>";                        
                    }
                ?>
            </select>
        <td>
        <td><input type="submit" name="aqueviewbnt" value="click"><td>
    </tr>
    <tr>
        <td>排水道</td>
        <td><select name=aquebtnsel>
                <option value="all-all">all</option>
                <?
                    $ary=showitem();
                    foreach($ary as $i){
                        echo "<option value='male-$i'>male $i</option>";                        
                    }
                    foreach($ary as $i){
                        echo "<option value='female-$i'>female $i</option>";                        
                    }
                ?>
            </select>
        <td>
        <td><input type="submit" name="aquebnt" value="click"><td>
    </tr>

    <tr>
        <td>查詢大毛巾購買狀況</td>
        <td><select name=towelviewsel>
                <option value="all">all</option>
            </select>
        <td>
        <td><input type="submit" name="towelviewbtn" value="click"><td>
    </tr>
    <tr>
        <td>是否截止報名(現在狀況:<?
            $k=mysql_fetch_row(mysql_query("select `deadline` from manage"));
            if($k[0]==1)echo "停止報名";
            else echo "開放報名";
        ?>)</td>
        <td><select name=stopsel>
                <option value="0">開放</option>
                <option value="1">截止</option>
            </select>
        <td>

        <td><input type="submit" name="stopbnt" value="click"><td>
    </tr>
</table>
</form>
<div>

