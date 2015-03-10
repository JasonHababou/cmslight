<?php
	session_start();
//error_reporting(E_ALL ^ E_DEPRECATED);
	require('setup/setup_php.php');
	require('includes/globals.php');

	if (!$chapter = node::get_node_by_id($_GET['chapter']))	die;
	if ($chapter->AccessDenied()) {
		header('Location:login.php');
	}
?>

<html>
<head>
	<link type="text/css" rel="stylesheet" href="css/default.css">
</head>
<body>
<?php
	echo '<div class="nav_path">';
	echo build_path($chapter);
	echo '</div>';

	$_SESSION['chapter']		= $chapter->id();
	$_SESSION['paragraph']	= 0;
	
	$paragraph = $chapter->child_node();
	$chapter_id = $chapter->id();
	if ($paragraph) do {
		$paragraph_id = $paragraph->id();
		echo "<div>";
			echo "<div style='float:left; width: 300px;'>";
				echo "<a class='paragraph' href='show_paragraph.php?chapter=$chapter_id&paragraph=$paragraph_id'>";
				echo "&bull; ".$paragraph->title();
				echo "</a>";
			echo "</div>";
			if (isset($_SESSION['admin_mode'])) {
				echo "<a class='button' title='' href='manage/move_down.php?id=$paragraph_id'>&darr;</a>";
				echo "<a class='button' title='' href='manage/move_up.php?id=$paragraph_id'>&uarr;</a>";
				echo "<a class='button' title='Editer' href='manage/edit_section.php?chapter=$chapter_id&id=$paragraph_id'>E</a>";
				echo "<a class='button' title='Ajouter un fichier' href='manage/add_file.php?chapter=$chapter_id&id=$paragraph_id'>A</a>";
				echo "<a class='button' title='Supprimer' href='manage/remove_node.php?chapter=$chapter_id&id=$paragraph_id'>X</a>";
			}
		echo "</div><br/>";
	} while ($paragraph = $paragraph->next_node());
?>

<?php if (isset($_SESSION['admin_mode'])) { ?>
	<br/>
	<form method="post" action="manage/add_section.php">
		<input type="hidden" name="id" value="<?php echo $chapter->id(); ?>" />
		<input type="hidden" name="ischapter" value="1" />
		<input type="submit" value="Ajouter un paragraphe" />
	</form>
<?php } ?>

</body>
</html>
