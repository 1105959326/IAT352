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
    if($_SERVER['HTTPS'] != 'on'){
        header("Location: https://" . $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
        exit();
      }
}

function no_SSL(){
    if(isset($_SERVER['HTTPS']) &&  $_SERVER['HTTPS']== "on") {
        header("Location: http://" . $_SERVER['HTTP_HOST'] .
            $_SERVER['REQUEST_URI']);
        exit();
    }

}


?>