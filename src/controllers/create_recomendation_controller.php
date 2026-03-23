<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){



    require_once "create_rec_validator.php";
    $validation = new CrRecValidator($_POST);
    $errors = $validation->validateForm();

    if(empty($errors)){
        require_once __DIR__ . "/../models/create_rec_model.php";

        $createRecomendation = new CreateRecomendation($_POST);
        $createRecomendation->addRecToDatabase($_POST);


    }else{
        echo "Errors found:<br>";
        foreach ($errors as $field => $error_message) {
            echo ucfirst($field) . ": " . $error_message . "<br>";
        }
    }
}