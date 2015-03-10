<?php session_start(); ?>
<html>
<head><link type="text/css" rel="stylesheet" href="../css/default.css"></head>
<body>
<?php
	require('include.php');
	extract($_REQUEST);
	//import_request_variables("GP", "p_");

	$title	= trim($_POST['title']);

	if (isset($contentid) && strlen($title) != 0) {
	//die("UPDATE sections SET title='$title' WHERE id=$contentid");
		sql_query("UPDATE sections SET title='$title' WHERE id=$contentid");
		go_back();
		exit();
	}

	$n = node::get_node_by_id($id);
	$chapter	= node::get_node_by_id($chapter);
 	//var_dump($chapter);
	echo '<div class="nav_path">';
	if ($chapter) {
		echo build_path($chapter)."�diter paragraphe : ".$n->title();
	} else {
		echo build_path()."�diter chapitre : ".$n->title();
	}
	echo '</div>';
?>

<form method="post" action="#">
	<input type="hidden" name="contentid" value=<?php echo $n->content_id(); ?>>
	<input type="hidden" name="chapter" value="<?php  echo $n->title(); ?>">
	<table>
		<tr><td width="100">
			Titre :
		</td><td>
			<input type="text" name="title" value="<?php echo $n->title(); ?>" />
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
