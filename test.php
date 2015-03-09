<?php
require('setup/setup_php.php5');
require('includes/globals.php5');

$login='jaja';
$password='rara';
if (node::generateLogin($login,$password))
{
    echo "ça marche";
}

else
{
    var_dump(node::generateLogin($login,$password));
    echo "ça ne marche pas";
}
//node::addPermission($login);

?>