<?php

class SessionManager{
    
    public function __construct(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public function get($key, $default = null){
        return $_SESSION[$key] ?? $default;
    }


    public function does_has($key){
        return isset($_SESSION[$key]);
    }


    public function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public function remove($key){
        unset($_SESSION[$key]);
    }


    public function destroy(){{
        $_SESSION = [];
        session_destroy();
    }}
}