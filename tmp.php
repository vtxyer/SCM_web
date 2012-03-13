<html>
<script language=javascript>
changelist();
function changelist()
{
          switch(document.data.test.value)
                    {
                                    case "1":
                                                    document.all.namelist.innerHTML="<select name=actname><option value=1>u1A<option value=2>u1B</select>"
                                                                break;
                                                case "2":
                                                                document.all.namelist.innerHTML="<select name=actname><option value=1>u1A<option value=2>u1B<option value=3> u1C</select>"
                                                                            break;
                                                      }
}                                                                               
</script>     
                                                                         
<form name=data>                                                                          
<select name=test onChange=Javascript:changelist();>
<option value=0 selected>check
<option value=1>mis
<option value=2>csie
</select>
                                                                             
<div id=namelist></div>
                                                                               
</form>                                                                            
</html>

<?php
$a="dfsdfsfsdf3423423";
preg_match("/(df)(34)/",$a,$r);
echo "$r[0]<br/>";


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
        return 0;
}

$a="h223899209";
echo calc_sex($a);


?>
