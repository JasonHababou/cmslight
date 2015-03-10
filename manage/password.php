<?php session_start(); ?>

<html>
<head>
	<link type="text/css" rel="stylesheet" href="../css/default.css">
</head>
<body onload="document.getElementById('login').focus();">
<?php
	require('../setup/setup_php.php');
	require('../includes/globals.php');

	if (isset($_POST['login'])) {
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		if($login=='manage')
			if($password=='twn2006')
			{
			$_SESSION['admin_mode']=true;
			$chemin = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/../index.php';
			// Redirection du parent si login ok
			echo "<script>
			window.parent.location = '$chemin';
			</script>";
			}
		//sql_query(sprintf("UPDATE permissions SET login='%s', password=md5('%s') WHERE id=1", $login, $password));
		//die('mise ? jour effectu?e');
	}
?>
<?php
 /* //ESSAIS
echo $_SERVER["DOCUMENT_ROOT"];echo '<br>';
echo __DIR__;echo '<br>';
echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";echo '<br>';
echo "http://$_SERVER[HTTP_HOST]";echo '<br>';
echo "$_SERVER[REQUEST_URI]";echo '<br>';
echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);echo '<br>'; // OK !!!
*/
?>
<form method="post" target="_top" style="margin:0px;padding:0px;text-align:right">
<table border="0" cellspacing="0" cellpadding="4" style="border:1px black solid; margin-top:160px" align="center">
<tr>
	<td colspan="2" style="background:#006699; color:white; font-weight:bold">Identification</td>
</tr>
<tr>
	<td>login : </td>
	<td><input type="text" name="login" id="login" style="width:140px;border:1px solid gray" value='manage' /></td>
</tr>
<tr>
	<td>password :</td>
	<td><input type="password" name="password" style="width:140px;border:1px solid gray" value='twn2006'  /></td>
</tr>
<tr>
	<td colspan="2" style="text-align:right"><input type="submit" value="Ok" style="border:1px solid black; background:#006699; color:white" /></td>
</tr>
</table>
</form>
</body>

</html>
