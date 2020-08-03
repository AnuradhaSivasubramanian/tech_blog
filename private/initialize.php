<?php

ob_start(); //output buffering is turned on
// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

// Assign the root URL to a PHP constant
// * Do not need to include the domain
// * Use same document root as webserver
// * Can set a hardcoded value:
// define("WWW_ROOT", '/techblog/public');
// define("WWW_ROOT", '');
// * Can dynamically find everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);



require_once('functions.php');
require_once('database.php');

// -> All classes in directory
foreach (glob('classes/*.class.php') as $file) {
    require_once($file);
}

// Autoload class definitions
/**
 * my_autoload() is an autoload functions to locate the classes directory for all the class definitions
 *
 * @param string $class
 * @return void
 */
function my_autoload(string $class)
{
    if (preg_match('/\A\w+\Z/', $class)) {
        include('classes/' . $class . '.class.php');
    }
}
spl_autoload_register('my_autoload');

$db = db_connect();
Subject::set_db($db);