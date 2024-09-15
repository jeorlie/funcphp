<?php 
/**
 * 
 * 
 */

if(!defined('APP_ENGINE')) die('Incorrect rewrite base. Root must be public');
define('APP_ROOT_DIRECTORY', __dir__);

$sys_dir = APP_ROOT_DIRECTORY .'/system';
$dependencies = [
    'functions',
    'database',
    'config',
    'routes'
];

$parse = parse_url($_SERVER['REQUEST_URI']);
$url  = rtrim(ltrim($parse['path'], '/'), '/');
$url_segment = explode('/', $url);

foreach($dependencies as $dep){
    require $sys_dir . '/'. $dep .'.php';
}


// autoload helper if directory found
$helper_dir = APP_DIR . '/helpers';
if(is_dir($helper_dir)) {
    $scandHelpers = array_slice(scandir($helper_dir), 2);
    if(!empty($scandHelpers)){
        foreach($scandHelpers as $helper){
            $ext = substr($helper, -4);
            if($ext == '.php') require $scandHelpers .'/'. $helper;
        }
    }
}

// autoload model if directory found
$models_dir = APP_DIR . '/models';
if(is_dir($models_dir)) {
    $scandModels = array_slice(scandir($models_dir), 2);
    if(!empty($scandModels)){
        foreach($scandModels as $model){
            $ext = substr($model, -4);
            if($ext == '.php') require $models_dir .'/'. $model;
        }
    }
}

// $controller_dir = APP_DIR . '/controllers';
// if(is_dir($controller_dir)) {
//     $scandControllers = array_slice(scandir($controller_dir), 2);
//     if(!empty($scandControllers)){
//         foreach($scandControllers as $controller){
//             $ext = substr($controller, -4);
//             if($ext == '.php') require $controller_dir .'/'. $controller;
//         }
//     }
// }


if(func_is_empty($url)){
    $url = 'index';
}

$routes = app_system_routes();
$uri= explode('/', $url);
func_set_globals('URL_SEGMENT', $uri);

$file = APP_DIR . '/controllers'. '/'. $uri[0].'.php';

if(file_exists($file)) {
    require $file;
} else {
   func_web_response([
     'title' => 'Page not found',
     'message' => 'The page your are looking for does not exists'
   ]);
}