<?php

function is_post_request(){
    return $_SERVER['REQUEST_METHOD']=='POST';
};

function is_get_request(){
    return $_SERVER['REQUEST_METHOD']=='GET';
};

function h($string="") {
    return htmlspecialchars($string);
};
  
function require_SSL(){
    //change http to https, for security (user's information pages)
    if($_SERVER['HTTPS'] != 'on'){
        header("Location: https://" . $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
        exit();
      }
}

function no_SSL(){
    //change from https to https for regular page
    if(isset($_SERVER['HTTPS']) &&  $_SERVER['HTTPS']== "on") {
        header("Location: http://" . $_SERVER['HTTP_HOST'] .
            $_SERVER['REQUEST_URI']);
        exit();
    }

}


?>