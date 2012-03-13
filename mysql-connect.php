<?php
$link = mysql_connect("", "root", "nctuswim") or die("Could not connect : " . mysql_error()); 
mysql_query("SET NAMES utf8");
mysql_select_db("SCM") or die("Could not select database");
session_start();


/*function mysqlConnect(){
  $link = mysql_connect("", "root", "nctuswim") or die("Could not connect : " . mysql_error()); 
  mysql_query("SET NAMES utf8");
  mysql_select_db("SCM") or die("Could not select database");
  }*/


function check(){
    if($_SESSION['id']==NULL){
        echo '尚未登入';
        exit;
    }
}

function deadline(){
    $s=mysql_query("select deadline from manage");
    $r=mysql_fetch_row($s);
    if($r[0]==1){
        echo '停止報名';
        exit;
    }
}

function admin(){
    if( ($_SESSION['id']!=1 && $_SESSION['id']!=2) ){
        return 0;
    }
    else{
        return 1;
    }
}
function showitem(){
    $ary=array('50free','100free','200free','400free',
            '50bk','100bk','200bk',
            '50fly','100fly','200fly',
            '50br','100br','200br','200im'     
            ); 
    return $ary;
}
function showschool(){
    $query="select id,sname from school";
    $r=mysql_query($query);
    $ary=array();

    while($s=mysql_fetch_row($r)){
        array_push($ary,"$s[0]-$s[1]");
    }

    return $ary;
}

function resizeImage($files){
    $filename="SCMphotoSe/".$files;
    $sfilename ="SCMphotoSe/".$files;
    // Get new sizes
    list($width, $height) = GetImageSize($filename);
    $percent= 150/$height;
    $newwidth = $width * $percent;
    $newheight = 150;

    // Load
    $thumb = imageCreatetruecolor($newwidth, $newheight);
    $source = ImageCreateFromJPEG($filename);

    // Resize
    imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    // Output
    ImageJPEG($thumb,$sfilename);
}
?>
