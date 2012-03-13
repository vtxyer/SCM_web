<?php
//phpinfo();
//exit();

if(isset($_POST['submit'])){
    $uploaddir = '/tmp/';
    $file = $uploaddir.basename($_FILES['photo']['name']);
    echo  $uploaddir.basename($_FILES['photo']['name'])."<br/>";
    if(copy($file, '.'))
        echo "OK";
    else
        echo "no";
}

?>
