<?php

require_once  '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../src/views');

$twig = new \Twig\Environment($loader, [
    'debug' => true,
]);

$router = new AltoRouter();



$routes = array(
    array('GET', '/', function() use($twig){
        echo $twig->render('home.html.twig');
    }, 'home'),

    array('GET', '/create-recomendation', function() use($twig){
        echo $twig->render('create-recomendation.html.twig');
    }, 'create-recomendation' ),

    array('GET', '/about', function() use($twig){
        echo $twig->render('about.html.twig');
    }, 'about'),

    array('GET', '/login', function()use($twig){
        echo $twig->render('login.html.twig');
    }, 'login'),

    array('GET', '/sign-up', function() use($twig){
        echo $twig->render('sign-up.html.twig');
    }, 'sign-up'),

    array('GET', '/welcome', function() use($twig){
        echo $twig->render('welcome.html.twig');
    }, 'welcome'),

    array('GET', '/users/[*:user-name]', function() use($twig){
        echo $twig->render('profile.html.twig');
    }, 'user-profile'),

    array('GET', '/items/[*:item-name]', function() use($twig){
        echo $twig->render('item.html.twig');
    }, 'item'),

    array('GET', '/watch-recomendation', function() use($twig){
        echo $twig->render('watch-recomendation.html.twig');
    }, 'watch-recomendation'),
);

$router->addRoutes($routes);

$match = $router->match();

if($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
}else{
    header($_SERVER['SERVER_PROTOCOL'].'404 not found');
}

