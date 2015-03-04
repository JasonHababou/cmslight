<?php
	session_start();
?><!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Télécoms et Réseaux TWN : Menu</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link rel="stylesheet" type="text/css" href="css/default.css" />
</head>
<body style="margin:1px; padding:0px;">
<?php
	require("setup/setup_php.php5");
	require("includes/globals.php5");
	
	if ($_SESSION[admin_mode]) {
		echo '<a class="root" target="frameContents" href="show_root.php5">RACINE</a>';
	}
	
	$chapter = node::get_root_node()->child_node();
	if ($chapter) do {
		$chapter_id = $chapter->id();
		echo '<div><a class="chapter" target="frameContents" href="show_chapter.php5?chapter=$chapter_id">';
		echo $chapter->title();
		echo '</a></div>';
		
		$paragraph = $chapter->child_node();
		if ($paragraph) do {
			$paragraph_id = $paragraph->id();
			echo '<div><a class="paragraph" target="frameContents" href="show_paragraph.php5?chapter=$chapter_id&amp;paragraph=$paragraph_id">';
			echo $paragraph->title();
			echo '</a></div>';
		} while ($paragraph = $paragraph->next_node());
	
	} while ($chapter = $chapter->next_node());
?>
</body>
</html>
