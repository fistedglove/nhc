<?php

/**
 * This file contains the Configuration for this National Health Club HQ Distributed Information Systems
 * Modify with Caution
 */
 
	 defined("DB_SERVER")? NULL:define("DB_SERVER", "localhost");
	 defined("DB_NAME")? NULL: define("DB_NAME", "nationalhealthclubhq");
	 defined("DB_USER")? NULL: define("DB_USER", "root");
	 defined("DB_PASS")? NULL: define("DB_PASS", "");
	 defined("HOST")? NULL: define("HOST", "mysql");
	 defined("SITE_ROOT")? NULL : define("SITE_ROOT", realpath("."));
	 defined("DS")? NULL : define("DS", "/");
	 defined("WEBSITE")? NULL : define("WEBSITE", "http://localhost");
	 defined("APP_PATH")? NULL : define("APP_PATH", dirname(WEBSITE.$_SERVER['PHP_SELF']));

	include_once('lib/database.php');
	include_once('lib/functions.php');
	include_once('lib/session.php');
	include_once('lib/pagination.php');

?>