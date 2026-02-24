<?php
// dev
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// end dev




require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader( __DIR__ . '/../src/views');

$twig = new \Twig\Environment($loader, [
    'debug' => true,
]);

$router = new AltoRouter();

if(session_status() == PHP_SESSION_NONE){
            session_start();
}

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

    array('GET', '/login', function() use($twig){
        require_once __DIR__ . "/../src/controllers/login_controller.php";
        echo $twig->render('login.html.twig');
    }, 'login'),

    array('GET', '/sign-up', function() use($twig){
        echo $twig->render('sign-up.html.twig');
    }, 'sign-up'),

    array('GET', '/welcome', function() use($twig){
        echo $twig->render('welcome.html.twig');
    }, 'welcome'),

    array('GET', '/users/[i:id]', function($id) use($twig){
        require_once __DIR__ . "/../src/controllers/login_controller.php";
        echo $twig->render('profile.html.twig');
    }, '/users/[i:id]'),

    array('GET', '/items/[*:item_name]', function() use($twig){
        echo $twig->render('item.html.twig');
    }, 'item'),

    array('GET', '/watch-recomendation', function() use($twig){
        echo $twig->render('watch-recomendation.html.twig');
    }, 'watch-recomendation'),
    array('POST', '/submit-signup-form', function(){
        require_once __DIR__ . '/../src/controllers/signup_controller.php';
    }, "/submit-signup-form"),
    array("POST", "/submit-login-form", function(){
        require_once __DIR__ . "/../src/controllers/login_controller.php";
    }, "submit-login-form"),
    array("GET", "/logout", function(){
        require_once __DIR__ . "/../src/controllers/logout_controller.php";
    }),

    
);

$twig->addGlobal("session", $_SESSION);

if(isset($_SESSION['login_error_message']) || isset($_SESSION['password_error_message'])){
    unset($_SESSION['login_error_message']);
    unset($_SESSION['password_error_message']);
}

$router->addRoutes($routes);

$match = $router->match();


if(is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
}else{
    header($_SERVER['SERVER_PROTOCOL'].'404 not found');
    die("<h1>Router Error</h1> No route matched for: " . $_SERVER['REQUEST_URI'] . " using " . $_SERVER['REQUEST_METHOD']); // dev
}

