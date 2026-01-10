<?php

require_once  '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../src/views');

$twig = new \Twig\Environment($loader, [
    'debug' => true,
]);

$route = new AltoRouter();

$route->map('GET', '/', function() use($twig){
    
    echo $twig->render('home.html.twig');

}, 'home');

$match = $route->match();

if($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
}else{
    header($_SERVER['SERVER_PROTOCOL'].'404 not found');
}