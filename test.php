<?php
require('setup/setup_php.php5');
require('includes/globals.php5');

$login='jaja';
$password='rara';
if (node::generateLogin($login,$password))
{
    echo "�a marche";
}

else
{
    var_dump(node::generateLogin($login,$password));
    echo "�a ne marche pas";
}
//node::addPermission($login);

?>