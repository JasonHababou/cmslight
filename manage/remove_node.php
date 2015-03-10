<?php
	session_start();
	require('include.php');

	extract($_GET);
	//import_request_variables("GP", "p_");
	if (!$n = node::get_node_by_id($id)) {
		die();
	}

//	echo '<div class="nav_path">';
//	echo build_path(node::get_node_by_id($p_chapter), node::get_node_by_id($p_paragraph));
//	echo '</div>';

	switch ($n->type()) {
	case TYPE_SECTION:
		$name = $n->title();
		break;
	case TYPE_FILE:
		$name = $n->path();
		break;
	}
	
	if ($confirm) {
		$n->remove_node();
		go_back();
		exit();
	}

?>

<html>
<head><link type="text/css" rel="stylesheet" href="../css/default.css"></head>
<body>
<form>
	<table>
		<tr><td style="padding-bottom:1.5em;">
			Supprimer <span style="font-variant:small-caps; color:red;"><?php echo $name; ?></span> ?
		</td></tr>
		<tr><td align="right">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="hidden" name="chapter" value="<?php echo $chapter; ?>" />
			<input type="hidden" name="paragraph" value="<?php echo $paragraph; ?>" />
			<input type="hidden" name="confirm" value="1" />
			<input type="submit" value="Oui" />
			<input type="button" value="Non" onclick="javascript:location='<?php echo build_back_url(); ?>'" />
		</td></tr>
	</table>
</form>
</body>
</html>