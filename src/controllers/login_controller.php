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
                $userSession->set("loginned_in", true);
                $userSession->set("userSessionName", $sessionName);
                

                $userSession->set("userFirstName", $credentials[0]["user_first_name"]);
                $userSession->set("userLastName", $credentials[0]["user_last_name"]);
                $fullName = $credentials[0]["user_first_name"] . $credentials[0]["user_last_name"];
                $fullnameUrl = urlencode($fullName);
                $idUrl = urlencode($credentials[0]["user_id"]);
                $user_email = $credentials[0]["user_email"];
                $userSession->set("user_email", "$user_email");

                header("Location: /users/" . $idUrl, true, 302);

                $profileInfo = [
                    'full_name' => $fullName,
                    'email' => $user_email
                ];

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