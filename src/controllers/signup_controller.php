<?php



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    


    require "validator.php";
    $validation = new Validator($_POST);
    $errors = $validation->validateForm();
    
    if(empty($errors)){
        require_once __DIR__ .  "/../models/signup_model.php";
        
        $signuping = new SignUping($_POST);
        $signuping->registrationOfUser($_POST);
        

    }else{
        echo "Errors found:<br>";
        foreach ($errors as $field => $error_message) {
            echo ucfirst($field) . ": " . $error_message . "<br>";
        }

    }

}