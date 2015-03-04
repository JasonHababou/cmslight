<?php session_start(); ?>

<html>
<head><link type="text/css" rel="stylesheet" href="css/default.css"></head>
<body style="margin:1px; padding:0px;">

<?php
error_reporting(E_ALL ^ E_DEPRECATED);
	require('setup/setup_php.php5');
	require('includes/globals.php5');

	if (isset($_SESSION['admin_mode'])) {
		echo "<a class='root' target='frameContents' href='show_root.php5'>";
		echo "RACINE";
		echo "</a>";
	}
	
	$chapter = node::get_root_node()->child_node();
	if ($chapter) do {
		$chapter_id = $chapter->id();
		echo "<a class='chapter' target='frameContents' href='show_chapter.php5?chapter=$chapter_id'>";
		echo $chapter->title();
		echo "</a>";
		
		$paragraph = $chapter->child_node();
		if ($paragraph) do {
			$paragraph_id = $paragraph->id();
			echo "<a class='paragraph' target='frameContents' href='show_paragraph.php5?chapter=$chapter_id&paragraph=$paragraph_id'>";
			echo $paragraph->title();
			echo '</a>';
		} while ($paragraph = $paragraph->next_node());
	
	} while ($chapter = $chapter->next_node());
?>
</body>
</html>
