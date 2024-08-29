<?php 
if(!defined('ENGINE')) exit;

error_reporting(E_ALL);
ini_set("display_errors", true);
date_default_timezone_set('Asia/Manila');

define('APP_ROOT_DIR', __dir__ .'/');
define('APP_DIR', APP_ROOT_DIR .'app/');
define('APP_MODULE_DIR', APP_DIR . 'modules/');
define('APP_VIEWS_DIR', APP_DIR . 'views/');


