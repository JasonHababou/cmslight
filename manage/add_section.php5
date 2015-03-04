<?php session_start(); ?>
<html>
<head><link type="text/css" rel="stylesheet" href="../css/default.css"></head>
<body>
<?php
	require("include.php5");

	import_request_variables("GP", "p_");
	if (!$parent = node::get_node_by_id($p_id)) {
		die();
	}

	if (strlen($p_title) != 0) {
		if ($n = node::get_node_by_id($p_id)) {
			sql_query("INSERT INTO sections (title) VALUES('$p_title')");
			$n->spawn_child(TYPE_SECTION, mysql_insert_id());
		}
		go_back();
		exit();
	}

	echo '<div class="nav_path">';
	if ($p_ischapter) {
		echo build_path($parent)."ajouter un paragraphe";
	} else {
		echo build_path()."ajouter un chapitre";
	}
	echo '</div>';
?>
<form method="post" enctype="multipart/form-data" action="#">
	<input type="hidden" name="id" value=<?php echo $p_id; ?>>
	<input type="hidden" name="ischapter" value=<?php echo $p_ischapter; ?>>
	<table>
		<tr><td width="100">
			Titre :
		</td><td>
			<input type="text" name="title" />
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
