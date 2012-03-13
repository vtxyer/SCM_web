<?
session_start();
include("mysql-connect.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<head>
<title>水道</title>
</head>
<?
    function push($ary,$size,$srcptr,$dstptr){
        $val=$ary[$srcptr];
        for($j=$srcptr;$j>$dstptr;$j--){
            $ary[$j]=$ary[$j-1];
        }
        $ary[$dstptr]=$val;
        return $ary;
    }

    function def_sort($ary,$size,$q){
        $ptr;
        for($k=0;$k<$size;$k++){
            $min=999;
            for($kk=$k;$kk<$size;$kk++){
                $data=split("-",$ary[$kk]);
                if($data[$q]<$min){
                    $min=$data[$q];
                    $ptr=$kk;
                }
            }
           $ary=push($ary,$size,$ptr,$k); 
        }
        return $ary;
    }

    $item=$_SESSION['item'];
    $sex=$_SESSION['sex'];
//    $_SESSION['item']=NULL;
//    $_SESSION['sex']=NULL;



//////////////////////////////////////////
/////////////////////////////////////////    
$startall=0;
$ary=array($item);
$sary=array($sex);

if(admin() && $item=="all"){
    $startall=1;
    $ary=showitem();
    $sary=array("male","female");
}

foreach($ary as $item){
foreach($sary as $sex){
    $itemname=$item.$sex;
    $query=
        "
        SELECT `name`,`id`,`time1_1`,`time1_2`,`time1_3`,`class`
        from `athlete`
        where `item1`='$item' and `sex`='$sex'
        ";
    $result=mysql_query($query);
    $itemdata=array();
    $i=0;
    while($r=mysql_fetch_row($result)){       
        $sname=mysql_fetch_row(mysql_query("select sname from school where id='$r[1]'")); 
        $itemdata[$i]=$r[0]."-".$sname[0]."-".$r[2]."-".$r[3]."-".$r[4]."-".rand(1,1000)."-".$r[5];
        $i++;
    }
    $query=
        "
        SELECT `name`,`id`,`time2_1`,`time2_2`,`time2_3`,`class`
        from `athlete`
        where `item2`='$item' and `sex`='$sex'
        ";
    $result=mysql_query($query);
    while($r=mysql_fetch_row($result)){       
        $sname=mysql_fetch_row(mysql_query("select sname from school where id='$r[1]'"));
        $itemdata[$i]=$r[0]."-".$sname[0]."-".$r[2]."-".$r[3]."-".$r[4]."-".rand(1,1000)."-".$r[5];
        $i++;
    }
    for($e=5;$e>=2;$e--){
        $itemdata=def_sort($itemdata,$i,$e);
    }


    @mysql_query("drop table $itemname");
    mysql_query("create table $itemname (
                name varchar(20),
                school varchar(20),
                canal int(2),
                class int(2),
                time varchar(14),
                aclass varchar(2)
            ) DEFAULT CHARACTER SET utf8
            ");
    $a=array(3,4,2,5,1,6,0,7);
    $p;
    $t;
    $s;
    $count=0;
    $as;
    foreach ($itemdata as $datum)
    {
        if($count==0)
        {
        }
        $f=split("-",$datum); 

        
        $g=intval($g/8)+2;
        $p[$a[$count]]=$f[0];
        $s[$a[$count]]=$f[1];        
        $t[$a[$count]]=$f[2].":".$f[3].".".$f[4];

        
        if($f[6]=='A'){
            $as[$a[$count]]="甲";
        }
        else{
            $as[$a[$count]]="乙";
        }

        if($count==7)
        {
            //echo 'NO';
            for($i=0;$i<8;$i++)
            {
                if($p[$i]!=NULL)
                {
                    $query="insert into `$itemname` set 
                            `name`='$p[$i]',
                            `school`='$s[$i]',                                
                            `canal`='$i+1',
                            `class`='$g',
                            `time`='$t[$i]',
                            `aclass`='$as[$i]'
                        ";
                    if(!mysql_query($query))
                        echo mysql_error();
/*                ?>
                    <tr>
                    <td><?echo $p[$i];?></td>
                    <td><?echo $s[$i];?></td>
                    <td><?echo ($i+1);?></td>
                    <td><?echo $g;?></td>
                    <td><?echo $t[$i];?></td>
                    </tr>
                    <?*/
                    $p[$i]=NULL;
                    $t1[$i]=NULL;
                    $t2[$i]=NULL;
                }
            }
        } 
        $g--;
        $count++;
        $count=$count%8;
      
    }

    for($i=0;$i<8;$i++)
    {
        if($p[$i]!=NULL)
        {

                    $query="insert into `$itemname` set 
                            `name`='$p[$i]',
                            `school`='$s[$i]',                                
                            `canal`='$i+1',
                            `class`='$g',
                            `time`='$t[$i]',
                            `aclass`='$as[$i]'
                        ";
                    mysql_query($query);
/*        ?>
            <tr>
            <td><?echo $p[$i];?></td>
            <td><?echo $s[$i];?></td> 
            <td><?echo ($i+1);?></td>
            <td><?echo $g;?></td>
            <td><?echo $t[$i];?></td>
            </tr>
        <?*/
        $p[$i]=NULL;
        $t1[$i]=NULL;
        $t2[$i]=NULL;
        }
    }
}
}
echo "完成!!!";
echo '<meta http-equiv=REFRESH CONTENT=1;url=manage.php>';
?>

