<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){



    require_once "login_validator.php";
    $validation = new LoginValidator($_POST);
    $errors = $validation->validateForm();

    if(empty($errors)){
        require_once __DIR__ . "/../models/login_model.php";
        $logining = new Logining($_POST);
        $correctLoginName = $logining->checkIfUserToLoginExists($_POST["loginname"]);
        if($correctLoginName){
            $credentials = $logining->getCredentialsFromLoginName($_POST);
            if($logining->checkPassword()){
                require_once __DIR__ . "/../models/session_model.php";
                $userSession = new SessionManager();
                $sessionName = $_POST["loginname"];
                $userSession->set("userSessionName", $sessionName);
                
            
                $userSession->set("userFirstName", $credentials["user_first_name"]);
                $userSession->set("userLastName", $credentials["user_last_name"]);
                header("Location: /users/prifile");

            }else{
                // "wrong password";
                $logining->passwordError();
                
                
            }

        }else{
            //"login not found";
            $logining->loginError();

            
        }


    }else{
        echo "Errors found:<br>";
        foreach ($errors as $field => $error_message) {
            echo ucfirst($field) . ": " . $error_message . "<br>";
        }

    }
}