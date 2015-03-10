<?php

require('../setup/setup_php.php');
require('../includes/globals.php');


function build_back_url() {
	if (isset($_SESSION['paragraph'])) {
		return '../show_paragraph.php?chapter='.$_SESSION['chapter'].'&paragraph='.$_SESSION['paragraph'];
	} elseif (isset($_SESSION['chapter'])) {
		return '../show_chapter.php?chapter='.$_SESSION['chapter'];
	} else {
		return '../show_root.php';
	}
}

function go_back() {
	echo "<script language='javascript'>location='".build_back_url()."';parent.frames['frameMenu'].location.reload();</script>";
	die();
}

?>
