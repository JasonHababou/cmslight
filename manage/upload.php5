<?php
	require('include.php5');
	if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['destnode']) {
		if (($node = node::get_node_by_id($_POST['destnode'])) == null) {
			die("Paragraphe inexistant.");
		}
		$src = sprintf("../upload/%s", $_POST['f']);
		$dest = sprintf("../contents/%s", $_POST['f']);
		if (!file_exists($src)) {
			die("Impossible d'accéder au fichier à copier.");
		}
		if (file_exists($dest)) {
			die("Le fichier existe déjà.");
		}
		if (!copy($src, $dest)) {
			die("Echec de copie.");
		}
		$q = sprintf("INSERT INTO files(path, author, comment) VALUES('%s','%s','%s')",
			$_POST['f'], $_POST['author'], $_POST['comment']);
		sql_query($q);
		$node->spawn_child(TYPE_FILE, mysql_insert_id());
		unlink($src);
		unset($_POST['f']);
		unset($_POST['destnode']);
		unset($_POST['author']);
		unset($_POST['comment']);
	}

	// check for new files
	$d = @opendir("../upload");
	if ($d) while (($f = readdir($d)) !== false) {
		if (is_dir($f)) {
			continue;
		}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
		"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>Upload de fichier</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<style type="text/css" media="all">
	fieldset {
		margin: auto;
		width: 300px;
	}
	fieldset p {
		margin: 6px 0px;
	}
	fieldset p#submit {
		margin-top: 16px;
		text-align: center;
	}
	fieldset label {
		display: block;
		float: left;
		width: 120px;
	}
	option.chapter {
		font-weight: bold;
	}
	option.paragraph {
		padding-left: 1em;
	}
	</style>
</head>
<body>
	<form action="#" method="post">
	<fieldset>
	<legend>Upload de fichier</legend>
	<input type="hidden" name="f" value="<?php echo $f ?>">
	<p>Fichier : <?php echo $f ?></p>
	<p>Taille : <?php echo round(filesize("../upload/".$f)/1024) ?> ko</p>
	<p><label for="author">Auteur</label><input id="author" type="text" name="author" value="<?php echo $_POST['author'] ?>"></p>
	<p><label for="comment">Commentaire</label><input id="comment" type="text" name="comment" value="<?php echo $_POST['comment'] ?>"></p>
	<p><label for="destnode">Déplacer vers</label>
		<select id="destnode" name="destnode">
		<option></option>
<?php
	if ($chapter = node::get_root_node()->child_node()) do {
		printf("\t\t<option class=\"chapter\" value=\"\">%s</option>", $chapter->title());
		if ($paragraph = $chapter->child_node()) do {
			printf("\t\t<option class=\"paragraph\" value=\"%s\" %s>%s</option>\n", $paragraph->id(), ($_POST['destnode']==$paragraph->id()) ? "selected" : "", $paragraph->title());
		} while ($paragraph = $paragraph->next_node());
	} while ($chapter = $chapter->next_node());
?>
		</select>
	</p>
	<p id="submit"><input type="submit" value="Insérer le fichier"></p>
	</fieldset>
	</form>
</body>
</html>
<?php
		die();
	}
	header("Location: /");
?>