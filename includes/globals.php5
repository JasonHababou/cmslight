<?php
// Report all errors except E_NOTICE
// This is the default value set in php.ini
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

require('c_node.php5');
require('c_file.php5');
require('c_root.php5');
require('c_section.php5');


$doc_maxpath	= 38;


function build_path($chapter =NULL, $paragraph =NULL) {
	$path = "";

	if (isset($_SESSION['admin_mode'])==true) {
		$path .= "<a href=show_root.php5'>RACINE ></a> ";
	}
	if ($chapter && $chapter->type() == TYPE_SECTION) {
		$path .= "<a href=show_chapter.php5?chapter=".$chapter->id().">";
		$path .= $chapter->title()." >";
		$path .= "</a>" ;

		if ($paragraph && $paragraph->type() == TYPE_SECTION) {
			$path .= "<a href=show_paragraph.php5?chapter=".$chapter->id()."&paragraph=".$paragraph->id().">";
			$path .= $paragraph->title()." >";
			$path .= "</a>" ;
		}
	}

	return $path;
}
function sql_query($query) {
	mysql_connect($GLOBALS['db_hostname'], $GLOBALS['db_user'], $GLOBALS['db_password']);
	mysql_selectdb($GLOBALS['db_database']);

	return mysql_query($query);
}

function sql_query_single_line($query) {
	$res = sql_query($query);
	return ($res) ? mysql_fetch_array($res) : NULL;
}

function sql_query_single_value($query) {
	if (!$data = sql_query_single_line($query)) {
		return NULL;
	}
	return $data[0];
}

?>
