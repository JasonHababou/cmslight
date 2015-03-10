<?php session_start(); ?>
<html>
<head><link type="text/css" rel="stylesheet" href="../css/default.css"></head>
<body>
<?php
	require('include.php5');

	extract($_REQUEST);
	//import_request_variables("GP", "p_");

	$author		= trim($author);
	$comment	= trim($comment);

	if (isset($contentid)) {
		sql_query("UPDATE files SET author='$author', comment='$comment' WHERE id='$contentid'");
		go_back();
		exit();
	}

	$n			= node::get_node_by_id($id);
	$chapter	= node::get_node_by_id($chapter);
	$paragraph	= node::get_node_by_id($paragraph);

	echo '<div class="nav_path">';
	echo build_path($chapter, $paragraph)."éditer ".$n->path();
	echo '</div>';
?>

<form method="post" action="#">
	<input type="hidden" name="contentid" value=<?php echo $n->content_id(); ?>>
	<input type="hidden" name="chapter" value=<?php echo $chapter->id(); ?>>
	<input type="hidden" name="paragraph" value=<?php echo $paragraph->id(); ?>>
	<table>
		<tr><td width="100">
			Auteur :
		</td><td>
			<input type="text" name="author" value="<?php echo $n->author(); ?>" />
		</td></tr>
		<tr><td>
			Commentaire :
		</td><td>
			<input type="text" name="comment" value="<?php echo $n->comment(); ?>" />
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
