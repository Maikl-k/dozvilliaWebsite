<?php

require_once("database.php");

class Logining{
    public $data;

    public function __construct($login_data){
        $this->data = $login_data;
    }

    public function checkIfUserToLoginExists($login_name): bool{

        $db = new DataBase();

        $searchUserByLoginNameSql = "SELECT login_name, user_email FROM Users WHERE login_name = ?;";
        $stmt = $db->getConnection()->prepare($searchUserByLoginNameSql);
        $stmt->execute([$login_name]);

        $result = $stmt->fetchAll();

        if(empty($result)){
            return false;
        }else{
            return true;
        }
    }

    public function gettingLoginCredentials($data){

        $db = new DataBase();
        $loginingSql = "SELECT login_name, user_password FROM Users WHERE login_name = ?;";

        if($this->checkIfUserToLoginExists($data["loginname"]) == true){

            $stmt = $db->getConnection()->prepare($loginingSql);

            try{
                $stmt->execute([$data["loginname"]]);
                $credentials = $stmt->fetchAll();

            }catch(PDOException $e){
                //echo "something wrong code 500"; // not dev
                // dev
                echo "Query failed: " . $e->getMessage();
                
            }
            return $credentials;

        }else{
            return null;
        }

    }

    public function checkingIfEnteringInWebsiteByCredentials($data){

        $credentialsForEnter = $this->gettingLoginCredentials($data);

        if($this->gettingLoginCredentials($data) != null){
            if(password_verify($data["user-password"], $credentialsForEnter["user_password"])){
                //good creddentials
                return true;
            }else{
                // user type wrong password
                return "wrong password";
            }
        }else{
            // user type wrong login name
            return "wrong login name";
        }
    }


}