<?php
/**
 * author: Jeorlie Edang
 * project: textbox.top
 */
define('ENGINE', true);
$curDir = __dir__ .'/';
require $curDir .'conf.php';
require $curDir .'routes.php';
require $curDir .'functions.php';

$_get_request_uri = parse_url($_SERVER['REQUEST_URI']);
$_parse_url = explode('/', ltrim($_get_request_uri['path'], '/'));
$_routes = application_routes();
if(empty($_parse_url[0]) && strlen($_parse_url[0]) == 0) {
    $_parse_url[0] = 'index';
}

if(!in_array($_parse_url[0], $_routes)) {
    header('Location: /', true, 301);
    exit;
}



$parentFolder = APP_MODULE_DIR . $_parse_url[0];
$moduleFile = $parentFolder . '/index.php';

if(isset($_parse_url[1])) {
    if(!empty($_parse_url[1]) && strlen($_parse_url[1]) > 0) {
        $moduleFile =$parentFolder . '/'. $_parse_url[1].'.php';
    }
}
if(file_exists($moduleFile)){
    require $moduleFile;
} else {
    func_web_error([
        'title' => 'Page not found',
        'message' => 'The page your are looking for cannot be found or does not exist.'
    ]);
}