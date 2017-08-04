<?php
require 'core.inc.php';
session_destroy();
header('Location: my_index.html');
echo 'Logged out ';
?>