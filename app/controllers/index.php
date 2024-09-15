<?php 

class IndexController {
    
    function __construct()
    {
        
    }

    public function renderLogin(){
        echo 'login page';
    }

    public function renderDefault(){
        echo 'home page';
    }
}

$app = new IndexController();
$segment = func_get_url_segment();
if(isset($segment[1])) {
    switch($segment[1]){
        case 'login';
            $app->renderLogin();
        break;
        default:
            func_web_response(404);
    }
} else {
    $app->renderDefault();
}