<?php session_start(); ?>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="../css/default.css">
</head>
<body>
<?php
require('include.php5');
//echo "$parent $id";echo '<br>';var_dump(node);
extract($_POST);


//import_request_variables("GP", "p_");

if (!$parent = node::get_node_by_id($id)) {
    die();
}

if (strlen($title) != 0) {
    if ($n = node::get_node_by_id($id)) {
        sql_query("INSERT INTO sections (title) VALUES('$title')");
        $n->spawn_child(TYPE_SECTION, mysql_insert_id());
    }
}

if ($_POST['cbprive'])
{
    $login = $_POST['title'];
    $password=node::passwordGenerate();
    node::generateLogin($login,$password);
    node::addPermission($login);

}

echo '<div class="nav_path">';

if ($_POST['test']==1)
{
    if($_POST['cbprive']) {

        echo "Login : " . $login;
        echo "<br><br>";
        echo "Mot de passe : " . $password;

        echo "<script type='text/javascript'>\n";
        echo "parent.frameMenu.window.location = '../menu.php5';\n";
        echo "</script>\n";
        ?>
        <br>
        <br>
        <input type="button" value="Retour" onclick="parent.frameContents.window.location = '../show_root.php5'"/>
        <?php
    }
    else{
        go_back();
    }
}
else{
    echo build_path() . "ajouter un chapitre";



echo '</div>';
?>
<form method="post" enctype="multipart/form-data" action="#">
    <input type="hidden" name="id" value=<?php echo $id; ?>>
    <input type="hidden" name="ischapter" value=<?php echo $ischapter; ?>>
    <input type="hidden" name="test" value="1">
    <table>
        <tr>
            <td width="100">
                Titre :
            </td>
            <td>
                <input type="text" name="title"/>
            </td>

        </tr>
        <tr>
            <td width="100">
                Rendre le chapitre privé ? :
            </td>
            <td>
                <input type="checkbox" name="cbprive"/>
            </td>

        </tr>
        <tr>
            <td colspan="2" align="right">
                <br/>
                <input type="submit" value="enregistrer" />
                <input type="button" value="annuler" onclick="javascript:location='<?php echo build_back_url(); ?>'"/>
            </td>
        </tr>
    </table>
</form>

</body>
</html>
<?php } ?>