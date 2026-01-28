<?php

require_once "validator.php";



if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $validation = new Validator($_POST);
    $errors = $validation->validateForm();
    
    if(empty($errors)){
        // need send to model data into database
    }else{
        echo "Errors found:<br>";
        foreach ($errors as $field => $error_message) {
            echo ucfirst($field) . ": " . $error_message . "<br>";
        }

    }

}