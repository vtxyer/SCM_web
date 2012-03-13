<?php
session_start();
$_SESSION['id']=NULL;
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />

<form action="checkpasswd.php" method="post" align="center"> 
<table align="center" height="10%"> 
<tr><td align="center" MAXLENGTH=15><label for="login">Login:</label></td><td><input type="text" id="login" name="at" value="" size="15" maxlength="15" /></td></tr> 
<tr><td align="center" MAXLENGTH=15><label for="passwd">Password:</label></td><td><input type="password" id="pw" name="pw" value="" size="15" maxlength="255" /></td></tr> 
<tr><td colspan="2" align="center"><input type="submit" name="Login" value="Login" /></td></tr>
</table> 
</form> 

<?php
//if($_SESSION['account']!=NULL)echo 'okk';
//echo $_POST['pw'];
?>

</body> 
</html> 
