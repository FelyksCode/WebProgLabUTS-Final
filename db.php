<?php
define('DSN', 'mysql:host=localhost;dbname=utswebproglab');
define('DBUSER', 'root');
define('DBPASS', '');

$db = new PDO(DSN, DBUSER, DBPASS);
