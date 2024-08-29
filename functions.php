<?php 
if(!defined('ENGINE')) exit;

function func_debug($t){
    echo '<pre>';
    print_r($t);
    echo '</pre>';
    exit;
}

function func_view($arrFile, $vars = []){
    if(is_array($arrFile)){
        foreach($arrFile as $file){
            require APP_VIEWS_DIR . $file. '.tpl.php';
        }
    } else {
        require APP_VIEWS_DIR . $arrFile. '.tpl.php';
    }
}


function func_web_error($array){
    $title = isset($array['title']) ? $array['title']: 'Page not found';
    $message =  isset($array['message']) ? $array['message']: 'Sorry, the page your looking does not exist.';
    $str = '
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>'. $title. '</title>
            <style>
             *{padding:0;margin:0;}
            </style>
        </head>
        <body>
            <div style="padding:0.5em;margin-top:10%;text-align:center">
                <h1>'. $title . '</h1>
                <p>'. $message. '</p></br>
                <a href="/">Home</a>
            </div>
        </body>
    </html>
    ';
    echo $str;
    exit;
}