<?php
// MUTE NOTICES
error_reporting(E_ALL & ~E_NOTICE);

// LIB PATH
// ! MANUALLY CHANGE THIS IF PHP IS THROWING FILE-NOT-FOUND ERRORS !
define('PATH_LIB', __DIR__ . DIRECTORY_SEPARATOR);

// DATABASE SETTINGS
// ! CHANGE THESE TO YOUR OWN !

$config = parse_ini_file('../../private/dbconfig.ini');

define('DB_HOST', $config['servername']);
define('DB_NAME', $config['dbname']);
define('DB_CHARSET', 'utf8');
define('DB_USER', $config['username']);
define('DB_PASSWORD', $config['password']);
?>