<?php session_start(); ?>
<html>
<head><link type="text/css" rel="stylesheet" href="../css/default.css"></head>
<body>
<?php
	require("include.php5");

	extract($_REQUEST);
	
	//import_request_variables("GP", "p_");
	if (!$parent = node::get_node_by_id($id)) {
		die();
	}
	
	echo '<div class="nav_path">';
	echo build_path(node::get_node_by_id($chapter), $parent)."ajouter un fichier";
	echo '</div>';

	if (isset($_FILES[file])) {
		$filename = trim(basename($_FILES[file][name]));
		$filepath = '../contents/'.$filename;
		if (!strlen($filename)) {
			echo '<font color="red">Pas de fichier spécifié.</font>';
		} elseif (strlen($filename) > $GLOBALS[doc_maxpath]) {
			echo '<font color="red">Nom de fichier trop long.</font>';
		} elseif (file_exists($filepath)) {
			echo '<font color="red">Le fichier existe déjà.</font>';
		} elseif ($_FILES[file][error]
			|| $_FILES[file][size] == 0
			|| !move_uploaded_file($_FILES[file][tmp_name], $filepath)) {
			echo '<font color="red">Envoi de fichier échoué.</font>';
		} else {
			sql_query("INSERT INTO files(path, author, comment) VALUES('$filename','$author','$comment')");
			$parent->spawn_child(TYPE_FILE, mysql_insert_id());
			go_back();
			exit();
		}
	}
?>

<form method="post" enctype="multipart/form-data" action="#">
	<input type="hidden" name="id" value=<?php echo $id; ?>>
	<input type="hidden" name="chapter" value=<?php echo $chapter; ?>>
	<table>
		<tr><td colspan="2" align="right">
		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $GLOBALS[doc_maxsize]*1024; ?>" />
		<input type="file" name="file" />
		</td></tr>
		<tr><td width="100">
			Auteur :
		</td><td>
			<input type="text" name="author" value="<?php echo $author; ?>"/>
		</td></tr>
		<tr><td>
			Commentaire :
		</td><td>
			<input type="text" name="comment" value="<?php echo $comment; ?>" />
		</td></tr>
		<tr><td colspan="2" align="right">
			<br/>
			<input type="submit" value="enregistrer" />
			<input type="button" value="annuler" onclick="javascript:location='<?php echo build_back_url(); ?>'" />
		</td></tr>
	</table>
</form>

</body>
</html>
