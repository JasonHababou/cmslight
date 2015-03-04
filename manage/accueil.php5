
<?php
	include("../setup/setup_php.php5");
	
	$filename = "../contents/accueil/accueil.html";
	if (isset($_POST['text'])) $text = $_POST['text'];
	if (isset($text)) {
		$text = str_replace("\'", "'", $text);
		$text = str_replace('\"', '"', $text);
		$f = fopen($filename, "w");
		fwrite($f, $text);
		fclose($f);
		echo "<script language='javascript'>location.href='$filename';</script>";
		die();
	}

	if (filesize($filename)) {
		$f = fopen($filename, "r");
		$text = fread($f, filesize($filename));
		fclose($f);
	}
?>


<html>
<head><link type="text/css" rel="stylesheet" href="../css/default.css"></head>
<body>
<div class="nav_path">
<a href="<?php echo $filename; ?>">Accueil ></a>
</div>
<form method="post" action="#">
<table>
<tr><td>
<textarea name="text" rows="20" cols="68">
<?php
	echo $text;
?>
</textarea>
</td></tr>
<tr><td align="right">
	<input type="submit" value="Enregistrer" />
</td></tr>
</form>
</center>
</table>
</body>
</html>
