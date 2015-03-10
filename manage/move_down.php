<?php
	session_start();
	require('include.php');

	$n = node::get_node_by_id($_GET['id']);
	if ($n) {
		$n->move_down();
	}

	go_back();
?>
