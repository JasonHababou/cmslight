<?php

	session_start();
	$_SESSION[admin_mode] = true;
	
	header("Location: upload.php5");
	//echo '<script language="javascript">history.back();</script>';
?>
