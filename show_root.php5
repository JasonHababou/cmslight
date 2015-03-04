<?php session_start(); ?>

<html>
<head>
	<link type="text/css" rel="stylesheet" href="css/default.css">
</head>
<body>
<?php
	require('setup/setup_php.php5');
	require('includes/globals.php5');

	if (!$root = node::get_root_node())	die;

	echo '<div class="nav_path">';
	echo build_path();
	echo '</div>';
	
	$_SESSION['chapter']		= 0;
	$_SESSION['paragraph']	= 0;

	if ($chapter = $root->child_node()) do {
		$chapter_id = $chapter->id();
		
		echo "<div>";
			echo "<div style='float:left; width: 300px;'>";
				echo "<a class='chapter' href='show_chapter.php5?chapter=$chapter_id'>";
				echo $chapter->title();
				echo "</a>";
			echo "</div>";
			if (isset($_SESSION['admin_mode'])) {
				echo "<a class='button' title='' href='manage/move_down.php5?id=$chapter_id'>&darr;</a>";
				echo "<a class='button' title='' href='manage/move_up.php5?id=$chapter_id'>&uarr;</a>";
				echo "<a class='button' title='Editer' href='manage/edit_section.php5?id=$chapter_id'>E</a>";
				echo "<a class='button' title='Ajouter un paragraphe' href='manage/add_section.php5?id=$chapter_id&ischapter=1'>A</a>";
				echo "<a class='button' title='Supprimer' href='manage/remove_node.php5?id=$chapter_id'>X</a>";
			}
		echo "</div><br/>";
	
		if ($paragraph = $chapter->child_node()) do {
			$paragraph_id = $paragraph->id();

			echo "<div>";
				echo "<div style='float:left; width: 300px;'>";
					echo "<a class='paragraph' href='show_paragraph.php5?chapter=$chapter_id&paragraph=$paragraph_id'>";
					echo $paragraph->title();
					echo "</a>";
				echo "</div>";
				if (isset($_SESSION['admin_mode'])) {
					echo "<a class='button' style='color:gray;' title='' href='manage/move_down.php5?id=$paragraph_id'>&darr;</a>";
					echo "<a class='button' style='color:gray;' title='' href='manage/move_up.php5?id=$paragraph_id'>&uarr;</a>";
					echo "<a class='button' style='color:gray;' title='Editer' href='manage/edit_section.php5?chapter=$chapter_id&id=$paragraph_id'>E</a>";
					echo "<a class='button' style='color:gray;' title='Ajouter un fichier' href='manage/add_file.php5?chapter=$chapter_id&id=$paragraph_id'>A</a>";
					echo "<a class='button' style='color:gray;' title='Supprimer' href='manage/remove_node.php5?chapter=$chapter_id&id=$paragraph_id'>X</a>";
				}
			echo "</div><br/>";

		} while ($paragraph = $paragraph->next_node());
	} while ($chapter = $chapter->next_node());
?>

<?php if (isset($_SESSION['admin_mode'])) { ?>
	<br/>
	<form method="post" action="manage/add_section.php5">
		<input type="hidden" name="id" value="<?php echo $root->id(); ?>" />
		<input type="submit" value="Ajouter un chapitre" />
	</form>
<?php } ?>

</body>
</html>
