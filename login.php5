<?php
//test
	session_start();
	require('setup/setup_php.php5');
	require('includes/globals.php5');

	if (isset($_POST['login'])) {
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$result = sql_query_single_value(sprintf("SELECT id FROM permissions WHERE login='%s' AND password=md5('%s')", $login, $password));
		if ($result) {
			$_SESSION['login'] = $login;
			echo "<script language='javascript'>location='accueil.php5';parent.frames['frameMenu'].location.reload();</script>";
			die();
		}
		$login = null;
		$password = null;
	}
?>

<html>
<head>
	<link type="text/css" rel="stylesheet" href="css/default.css">
</head>
<body onload="document.getElementById('login').focus();">
<form method="post" action="#" style="margin:0px;padding:0px;text-align:right">
<table border="0" cellspacing="0" cellpadding="4" style="border:1px black solid; margin-top:160px" align="center">
<tr>
	<td colspan="2" style="background:#006699; color:white; font-weight:bold">Acces reserve</td>
</tr>
<tr>
	<td>login : </td>
	<td><input type="text" name="login" id="login" style="width:140px;border:1px solid gray" /></td>
</tr>
<tr>
	<td>password :</td>
	<td><input type="password" name="password" style="width:140px;border:1px solid gray" /></td>
</tr>
<tr>
	<td colspan="2" style="text-align:right"><input type="submit" value="Ok" style="border:1px solid black; background:#006699; color:white" /></td>
</tr>
</table>
</form>
</body>
</html>
