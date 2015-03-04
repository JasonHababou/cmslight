<?php
	session_start();
error_reporting(E_ALL ^ E_DEPRECATED  ^ E_NOTICE);	
	require('setup/setup_php.php5');
	require('includes/globals.php5');

	if (!$chapter	= node::get_node_by_id($_GET['chapter'])) die;
	if (!$paragraph	= node::get_node_by_id($_GET['paragraph']))	die;
	if ($chapter->AccessDenied()) {
		die();
	}
	if ($paragraph->AccessDenied()) {
		header('Location: /login.php5');
	}
?>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="css/default.css">
</head>
<body>
<?php
	echo '<div class="nav_path">';
	echo build_path($chapter, $paragraph);
	echo '</div>';

	$_SESSION['chapter'] = $chapter->id();
	$_SESSION['paragraph'] = $paragraph->id();

	$chapter_id = $chapter->id();
	$paragraph_id = $paragraph->id();
	if ($file = $paragraph->child_node()) do {
		
		$file_id = $file->id();
?>
		<a href="download.php5?f=<?= $file_id ?>">
			<div class="file">
				<div class="author">
					<?php if (strlen($file->author())) {
						echo "de ".$file->author();
					} ?>
				</div>
				<div class="path">
					<?php echo $file->path() ?>
				</div>
			</div>
		</a>
<?php 
		if (isset($_SESSION['admin_mode'])) {
			echo "<div style='float:left; margin-right:1.3em;'>";
			echo "<a class='button' title='' href='manage/move_down.php5?id=$file_id'>&darr;</a>";
			echo "<a class='button' title='' href='manage/move_up.php5?id=$file_id'>&uarr;</a>";
			echo "<a class='button' title='Editer' href='manage/edit_file.php5?chapter=$chapter_id&paragraph=$paragraph_id&id=$file_id'>E</a>";
			echo "<a class='button' title='Supprimer' href='manage/remove_node.php5?chapter=$chapter_id&paragraph=$paragraph_id&id=$file_id'>X</a>";
			echo "</div>";
		}
		echo '<div class="comment">';
		echo $file->comment();
		echo '</div>';
	} while($file = $file->next_node());
?>

<?php if (isset($_SESSION['admin_mode'])) { ?>
	<br/>
	<form method="post" action="manage/add_file.php5">
		<input type="hidden" name="id" value="<?php echo $paragraph->id(); ?>" />
		<input type="hidden" name="chapter" value="<?php echo $chapter->id(); ?>" />
		<input type="submit" value="Ajouter un fichier" />
	</form>
<?php } ?>

</body>
</html>

