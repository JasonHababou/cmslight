<?php	session_start();
if(isset($_GET['logout']))
	{
	session_destroy();
	session_start();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Télécoms et Réseaux TWN</title>
	<link rel="stylesheet" type="text/css" href="css/default.css" media="all" />
	<style type="text/css" media="all">
	#container {
		border-width:	1px;
		border-color:	#006699;
		border-style:	solid;
	}
	td {
		border-width:	1px;
		border-color:	#006699;
		border-style:	solid;
	}
	#footer {
		width:			900px;
		text-align:		right;
		line-height:	25px;
	}
	#logo {
		float:			left;
		margin-left:	2px;
	}
	.menu_cell {
		font-variant:	small-caps;
		font-weight:	bold;
		border-width:	0px;
	}
	a img {
		border: none;
	}
	</style>
</head>
<?php

$accueil_path = "accueil.php5";

if (isset($_SESSION['admin_mode']))	
	if (($_SESSION['admin_mode'])==true)	
		$accueil_path = "manage/accueil.php5";

?>
<body>
<?php // print_r($_SESSION); ?>
<table id="container" cellspacing="5" align="center">
	<tr>
		<td colspan="2" height="100">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="menu_cell" valign="middle">&nbsp;&nbsp;<img src="images/logo.png" alt="T?l?coms et R?seaux TWN" /></td>
<?php if (!isset($_SESSION['admin_mode'])) { ?>
				<td width="25%" class="menu_cell" align="center" valign="bottom"><a target="frameContents" href="manage/password.php5">Identification</a></td>
<?php } ?>				
<?php if (isset($_SESSION['admin_mode'])) { ?>
				<td width="25%" class="menu_cell" align="center" valign="bottom"><a href="index.php5?logout">Déconnexion</a></td>
<?php } ?>

				<td width="25%" class="menu_cell" align="center" valign="bottom"><a target="frameContents" href="<?= $accueil_path ?>">Accueil</a></td>
				<td width="25%" class="menu_cell" align="center" valign="bottom"><a href="mail.php5" target="frameContents">Mail</a><a href="mail.php5" target="frameContents"><img src="images/mail.jpg" alt="mail" /></a></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="300" height="450">
			<iframe name="frameMenu" src="menu.php5" width="100%" height="100%" frameborder="0"></iframe>
		</td>
		<td width="600" height="450">
			<iframe name="frameContents" src="<?php echo $accueil_path ?>" width="100%" height="100%" frameborder="0"></iframe>
		</td>
	</tr>
</table>
<center>
<div id="footer" align="center">
	<b>Site réalisé par Cyril Gantin</b>
</div>
</center>
</body>

</html>
