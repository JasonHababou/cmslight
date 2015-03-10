<?php
require('setup/setup_php.php');
require('includes/globals.php');
$password=node::passwordGenerate();
echo $password;

?>