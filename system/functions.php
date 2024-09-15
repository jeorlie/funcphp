<?php 
/**
 * 
 * 
 */
if(!defined('APP_ENGINE')) die('Access denied!');

function func_debug($t){
    echo '<pre>';
    print_r($t);
    echo '</pre>';
}

function func_json_response($r){
    ob_start();
    header('Content-type:application/json;');
    echo json_encode($r);
    ob_flush();
    exit;
}

function func_set_globals($key, $val){
    $GLOBALS['APP_GLOB_'. $key] = $val;
}


function func_var_globals($key){
    return isset($GLOBALS['APP_GLOB_'. $key]) ? $GLOBALS['APP_GLOB_'. $key] : false;
}

function func_is_empty($t){
    if(empty($t) && strlen($t) == 0) return true;
    else return false;
}

function func_get_url_segment(){
    return func_var_globals('URL_SEGMENT');
}

function func_json_error($r){
    $success = isset($r['success']) ? $r['success'] : false;
    $message = isset($r['message']) ? $r['message'] : '';
    func_json_response(array(
        'success' => $success,
        'message' => $message
    ));
}

function func_json_success($r){
    $success = isset($r['success']) ? $r['success'] : true;
    $message = isset($r['message']) ? $r['message'] : '';
    func_json_response(array(
        'success' => $success,
        'message' => $message
    ));
}

function func_web_response($t){
    $title = 'Error';
    $message ='Page error';
    $link = '/';
    if(is_numeric($t)){
        switch($t) {
            case 404:
                $title = 'Page not found';
                $message = 'The page you are looking for not found';
                break;
            default:            
                $title = 'Server Error';
                $message = 'An unknow error has occured.';
        }
    } else {
        $title = isset($t['title']) ? $t['title'] : 'Alert';
        $message = isset($t['message']) ? $t['message'] : 'Page not found.';
        $link = isset($t['link']) ? $t['link'] : '/';
    }

    $str = '
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>'. $title.'</title>
            </head>
            <body>
                <div style="padding:1em">
                    <h1>'.$title.'</h1>
                    <p>'. $message. '</p>
                    <a href="'. $link.'">Back</a>
                </div>
            </body>
        </html>
    ';
    ob_start();
    header('Content-type: text/html');
    echo $str;
    ob_flush();
    exit;
}

