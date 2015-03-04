<?php

	session_start();
	$_SESSION["admin_mode"] = false;
	
	echo '<script language="javascript">parent.location.href="../";</script>';

?>
