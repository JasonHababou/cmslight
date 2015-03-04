<?php
	require('setup/setup_php.php5');
	require('includes/globals.php5');

	if (!$_GET['f']) {
		die("Dying: file name not specified.");
	}
	$fnode = node::get_node_by_id($_GET['f']);
	if ($fnode->AccessDenied()) {
		die("Vous n'avez pas la permission d'accéder ? ce fichier.");
	}
	
	$fname = $fnode->path();
	$fpath = sprintf("contents/%s", $fname);
	if (!file_exists($fpath)) {
		die("Dying: file does not exist.");
	}

	preg_match('/\.(.*)$/', $fname, $match);
	$fext = strtolower($match[1]);
	if ($fext == 'pdf') {
		header('Content-type: application/pdf');
	} else {
		header('Content-type: application/octet-stream');
		header(sprintf('Content-Disposition: attachment; filename="%s"', $fname));
	}
    readfile($fpath);
	
	$usr_ip = $_SERVER['REMOTE_ADDR'];
	$usr_hostname = gethostbyaddr($usr_ip);
	sql_query("INSERT INTO stats(whn, file, usr_ip, usr_hostname, usr_agent)
				VALUES(now(), '$fname', '$usr_ip', '$usr_hostname', '{$_SERVER['HTTP_USER_AGENT']}')");
?>
