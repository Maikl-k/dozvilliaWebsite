<?php

require_once  '../vendor/autoload.php';

$route = new AltoRouter();

$route->map('GET', '/', function(){
    require '../src/views/home.php';
}, 'home');

$match = $route->match();

if($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
}else{
    header($_SERVER['SERVER_PROTOCOL'].'404 not found');
}