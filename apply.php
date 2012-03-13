<?
session_start();
include("mysql-connect.php");
check();
deadline();



function calc_sex($val){
    preg_match("/(\w)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)/",$val,$result);
    $wo=strtoupper($result[1]);
    $w=floor((ord($wo)-55)/10);
    $result[1]= (ord($wo)-55)%10;
    for($i=1;$i<=9;$i++){
        $w+=(10-$i)*$result[$i];
    }
    $w+=$result[10];
    if($w%10==0){
        if($result[2]==1)
            return "male";
        else
            return "female";
    }
    else 
        return 1;
}


function preValue($val,$selected){
    if($_SESSION['isPre']==1 && $selected==0){
        echo $_POST[$val];
    }
    elseif($_SESSION['isPre']==1 && $selected==1){
        return $_POST[$val];
    }
    elseif($_SESSION['isPre']==1 && $selected==2 && $_POST['class']=="A")
        echo "selected";
    elseif($_SESSION['isPre']==1 && $selected==3 && $_POST['item1']==$val)
        echo "selected";
    elseif($_SESSION['isPre']==1 && $selected==4 && $_POST['item2']==$val)
        echo "selected";
    else
        return -1;
}

$id=$_SESSION['id'];
if($_SESSION['fromChange']==1){
    $id=$_SESSION['tid'];
    $_SESSION['isPre']=1;
    $dnid=$_SESSION['dnid'];
    $query="select * from athlete where `nid`='$dnid'";
    $result=mysql_query($query);
    while($r=mysql_fetch_row($result)){
        $_POST['name']=$r[1];
        $bir=split("-",$r[3]);
        $_POST['birthday1']=$bir[0];
        $_POST['birthday2']=$bir[1];
        $_POST['birthday3']=$bir[2];
        $_POST['card-id']=$r[2];
        $_POST['pname']=$r[4];
        $_POST['class']=$r[5];
        $_POST['item1']=$r[6];
        $_POST['item2']=$r[10];
        $_POST['time1_1']=$r[7];
        $_POST['time1_2']=$r[8];
        $_POST['time1_3']=$r[9];
        $_POST['time2_1']=$r[11];
        $_POST['time2_2']=$r[12];
        $_POST['time2_3']=$r[13];
    }

    $_SESSION['fromChange']=2;
}




if(isset($_POST['button'])){
    $_SESSION['isPre']=1;
    $aname=$_POST['name'];
    $birthday=$_POST['birthday1']."-".$_POST['birthday2']."-".$_POST['birthday3'];
    $card_id=$_POST['card-id'];
    $pname=$_POST['pname'];
    $class=$_POST['class'];
    $item1=$_POST['item1'];
    $item2=$_POST['item2'];
    $time1_1=$_POST['time1_1'];
    $time2_1=$_POST['time2_1'];
    $time1_2=$_POST['time1_2'];
    $time2_2=$_POST['time2_2'];
    $time1_3=$_POST['time1_3'];
    $time2_3=$_POST['time2_3'];
    //    $id=$_SESSION['id'];

    $sex=calc_sex($card_id);

    if($time1_2!=99 && $time1_1==99)
        $time1_1=0;
    if($time2_2!=99 && $time2_1==99)
        $time2_1=0;


    $yn=0;

    if($aname==NULL)
    {
        $yn=1;
        echo '<div class=error>名字沒填悠!!</div>';?><br/><?
#            echo '<meta http-equiv=REFRESH CONTENT  =1;url=apply.php>';
    }
    if($birthday==NULL)
    {
        $yn=1;
        echo '<div class=error><p>生日沒填悠!!</p></div>';?><br/><?
#            echo '<meta http-equiv=REFRESH CONTENT  =1;url=apply.php>';
    }
    if($card_id==NULL)
    {
        $yn=1;
        echo '<div class=error>身分證沒填悠!!</div>';?><br/><?
#            echo '<meta http-equiv=REFRESH CONTENT  =1;url=apply.php>';
    }
    if($pname==NULL)
    {
        $yn=1;
        echo '<div class=error>監護人姓名沒填悠!!</div>';?><br/><?
#            echo '<meta http-equiv=REFRESH CONTENT  =1;url=apply.php>';
    }
    if($sex==1){
        $yn=1;
        echo "<div class=error>身分證錯誤!!</div><br/>";
    }
    if($item1==$item2){
        $yn=1;
        echo "<div class=error>兩個項目報一樣的 不行喔!!</div><br/>";
    }
    str_replace("\'","",$name);
    str_replace("\'","",$pname);


    if($yn==0)
    {
        if($_SESSION['fromChange']==2){
            $dnid=$_SESSION['dnid'];
            $query="
                update `athlete` set
                `nid`='$card_id',
                `name`='$aname',
                `birthday`='$birthday',
                `pname`='$pname',
                `class`='$class',
                `item1`='$item1',
                `item2`='$item2',
                `time1_1`='$time1_1',
                `time1_2`='$time1_2',
                `time2_1`='$time2_1',
                `time2_2`='$time2_2',
                `time1_3`='$time1_3',
                `time2_3`='$time2_3',
                `sex`='$sex'
                    where `nid`='$dnid' 
                    ";
        }
        else{
            $query="
                INSERT INTO `athlete` SET
                `id`='$id',
                `nid`='$card_id' ,
                `name`='$aname',
                `birthday`='$birthday',
                `pname`='$pname',
                `class`='$class',
                `item1`='$item1',
                `item2`='$item2',
                `time1_1`='$time1_1',
                `time1_2`='$time1_2',
                `time2_1`='$time2_1',
                `time2_2`='$time2_2',
                `time1_3`='$time1_3',
                `time2_3`='$time2_3',
                `sex`='$sex'
                    ";
        }

        if(mysql_query($query) )
        {
            $_SESSION['isPre']=0;
            if($_SESSION['fromChange']==2){
                $_SESSION['fromChange']=0;
                echo "修改成功.$query";
                echo "<meta http-equiv=REFRESH CONTENT=0;url=view.php>";
            }
            else{
                echo $aname;
                echo ' 報名成功';
            }
            if($_FILES['photo']['name']){
                $uploaddir = '/tmp/';
                $uppath = 'SCMphotoSe/';
                $randNum = rand(1,1000);
                $path = $uppath.basename($card_id);
                $file = $uploaddir.basename($_FILES['photo']['tmp_name']);                   
                $fileType = exec("file $file");
                if(preg_match("/ (\w+) image data.* /",$fileType,$match)){
                    $filename=$path.".".$match[1];
                    $imageName = $card_id.".".$match[1];
                    if(copy($file, $filename)){
                        resizeImage($imageName);
                        mysql_query("update athlete set photo_name='$imageName'");
                    }
                    else{
                        echo "照片上傳不成功<br/>";
                    }
                }
                else{
                    echo "照片格式錯誤<br/>";
                }       
            }
            else{
                echo " 但他沒有照片喔!!<br/>";
            }

        }
        else echo '失敗了優  再一次!';
    }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>報名系統</title>
</head>

<body>

<frame src="main.php" name="side" noresize></frame>
<form action="#" method="post" name="form1" class="style1" id="form1" enctype="multipart/form-data" >
<label>
<div align="center">
<p>選手姓名</p>
<p>
<input name="name" type="text" id="選手姓名" value="<?preValue("name",0)?>" size="10" />
</p>
</div>
</label>
<p align="center">
<label>生日 
</label>
<label>
<select name="birthday1"> 
<?
for($b1=1960;$b1<=1995;$b1++)
{
    if($b1!=preValue("birthday1",1))
        echo "<option value=$b1>$b1</option>";
    else
        echo "<option value=$b1 selected='selected'>$b1</option>";
}
?> 
</select>
年</label>
<label>
<select name="birthday2">
<?
for($b2=1;$b2<=12;$b2++)
{      
    if($b2!=preValue("birthday2",1))
        echo "<option value=$b2>$b2</option>";
    else
        echo "<option value=$b2 selected='selected'>$b2</option>";  
}
?> 
</select>
月</label>
<label>
<select name="birthday3">
<?
for($b3=1;$b3<=31;$b3++)
{ 
    if($b3!=preValue("birthday3",1))
        echo "<option value=$b3>$b3</option>";
    else
        echo "<option value=$b3 selected='selected'>$b3</option>";  
}
?>
</select>
日</label>
</p>
<p align="center">
<label>身分證<br />
<input type="text" name="card-id" id="選手姓名2" value="<?preValue("card-id",0)?>"/>
</label>
</p>
<p align="center">
<label>監護人姓名<br />
<input name="pname" type="text" id="選手姓名3" value="<?preValue("pname",0)?>" size="10" />
</label>
</p>
<label>
<div align="center">組別
<select name="class" id="組別">
<option value="B" selected>乙</option>
<option value="A" <?preValue("A",2)?>>甲</option>
</select>
</div>
</label>
<p align="center">
<label>報名項目1
<select name="item1" id="組別2">
<option <?preValue("50free",3)?> value="50free">50公尺自由式</option>
<option <?preValue("100free",3)?> value="100free">100公尺自由式</option>
<option <?preValue("200free",3)?> value="200free">200公尺自由式</option>
<option <?preValue("400free",3)?> value="400free">400公尺自由式</option>
<option <?preValue("50bk",3)?> value="50bk">50公尺仰式</option>
<option <?preValue("100bk",3)?> value="100bk">100公尺仰式</option>
<option <?preValue("200bk",3)?> value="200bk">200公尺仰式</option>
<option <?preValue("50fly",3)?> value="50fly">50公尺蝶式</option>
<option <?preValue("100fly",3)?> value="100fly">100公尺蝶式</option>
<option <?preValue("200fly",3)?> value="200fly">200公尺蝶式</option>
<option <?preValue("50br",3)?> value="50br">50公尺蛙式</option>
<option <?preValue("100br",3)?> value="100br">100公尺蛙式</option>
<option <?preValue("200br",3)?> value="200br">200公尺蛙式</option>
<option <?preValue("200im",3)?> value="200im">200公尺混合式</option>

</select>
</label>
<label>時間
<select name="time1_1">
<option value=99>無</option>
<?
for($tmp1_1=0;$tmp1_1<=15;$tmp1_1++)
{
    if($tmp1_1!=preValue("time1_1",1))
        echo "<option value=$tmp1_1>$tmp1_1</option>";
    else
        echo "<option value=$tmp1_1 selected='selected'>$tmp1_1</option>";     
}
?>
</select>
分</label>
<label>
<select name="time1_2">
<option value=99 selected>無</option>
<?
for($tmp1_2=0;$tmp1_2<=59;$tmp1_2++)
{
    if($tmp1_2!=preValue("time1_2",1))
        echo "<option value=$tmp1_2>$tmp1_2</option>";
    else{
        echo "<option value=$tmp1_2 selected>$tmp1_2</option>";       
    }
}
?>
</select>
秒</label>
<label>
<select name="time1_3">
<option value=99 selected>無</option>
<?
for($tmp1_3=0;$tmp1_3<=98;$tmp1_3++)
{
    if($tmp1_3!=preValue("time1_3",1))
        echo "<option value=$tmp1_3>$tmp1_3</option>";
    else{
        echo "<option value=$tmp1_3 selected>$tmp1_3</option>";       
    }
}
?>
</select>
</label>
</p>
<p align="center">
<label>報名項目2
<select name="item2" id="組別3">
<option value=NULL>無</option>
<option <?preValue("50free",4)?> value="50free">50公尺自由式</option>
<option <?preValue("100free",4)?> value="100free">100公尺自由式</option>
<option <?preValue("200free",4)?> value="200free">200公尺自由式</option>
<option <?preValue("400free",4)?> value="400free">400公尺自由式</option>
<option <?preValue("50bk",4)?> value="50bk">50公尺仰式</option>
<option <?preValue("100bk",4)?> value="100bk">100公尺仰式</option>
<option <?preValue("200bk",4)?> value="200bk">200公尺仰式</option>
<option <?preValue("50fly",4)?> value="50fly">50公尺蝶式</option>
<option <?preValue("100fly",4)?> value="100fly">100公尺蝶式</option>
<option <?preValue("200fly",4)?> value="200fly">200公尺蝶式</option>
<option <?preValue("50br",4)?> value="50br">50公尺蛙式</option>
<option <?preValue("100br",4)?> value="100br">100公尺蛙式</option>
<option <?preValue("200br",4)?> value="200br">200公尺蛙式</option>
<option <?preValue("200im",4)?> value="200im">200公尺混合式</option>
</select>
</label>
<label>時間
<select name="time2_1">
<option value=99>無</option>
<?
for($tmp2_1=0;$tmp2_1<=15;$tmp2_1++)
{
    if($tmp2_1!=preValue("time2_1",1))
        echo "<option value=$tmp2_1>$tmp2_1</option>";
    else
        echo "<option value=$tmp2_1 selected='selected'>$tmp2_1</option>";         
}
?>
</select>
分</label>
<label>    
<select name="time2_2">
<option value=99>無</option>
<?
for($tmp2_2=0;$tmp2_2<=59;$tmp2_2++)
{
    if($tmp2_2!=preValue("time2_2",1))
        echo "<option value=$tmp2_2>$tmp2_2</option>";
    else
        echo "<option value=$tmp2_2 selected='selected'>$tmp2_2</option>";           
}
?>
</select>
秒</label>
<label>
<select name="time2_3">
<option value=99 selected>無</option>
<?
for($tmp2_3=0;$tmp2_3<=98;$tmp2_3++)
{
    if($tmp2_3!=preValue("time2_3",1))
        echo "<option value=$tmp2_3>$tmp2_3</option>";
    else{
        echo "<option value=$tmp2_3 selected>$tmp2_3</option>";       
    }
}
?>
</select>
</label>
<p align="center">
<label align="center">新增選手照片(不可大於2MB)<br/>
<input type="hidden" name="MAX_FILE_SIZE" value="2048000" />
<input name="photo" type="file" value="0" size="10" align="center">
</label>
</p>
<br/>
<br/>
</br>
<td><div align="center">
<input type="submit" name="button" id="button" value="送出" />
</div></td>
<div align="center">
</p>
</div>
</form>
</body>
</html>
