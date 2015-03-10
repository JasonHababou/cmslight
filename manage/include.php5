<?php

require('../setup/setup_php.php5');
require('../includes/globals.php5');


function build_back_url() {
	if (isset($_SESSION['paragraph'])) {
		return '../show_paragraph.php5?chapter='.$_SESSION['chapter'].'&paragraph='.$_SESSION['paragraph'];
	} elseif (isset($_SESSION['chapter'])) {
		return '../show_chapter.php5?chapter='.$_SESSION['chapter'];
	} else {
		return '../show_root.php5';
	}
}

function go_back() {
	echo "<script language='javascript'>location='".build_back_url()."';parent.frames['frameMenu'].location.reload();</script>";

}

?>
