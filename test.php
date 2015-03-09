<?php
require('setup/setup_php.php5');
require('includes/globals.php5');
$password=node::passwordGenerate();
echo $password;

?>