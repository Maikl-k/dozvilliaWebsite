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

    public function getCredentialsFromLoginName($data){

        $db = new DataBase();
        $loginingSql = "SELECT user_id, user_email, user_first_name, user_last_name, login_name, user_password FROM Users WHERE login_name = ?;";


            $stmt = $db->getConnection()->prepare($loginingSql);

            try{
                $stmt->execute([$data["loginname"]]);
                $credentials = $stmt->fetchAll();
                return $credentials;

            }catch(PDOException $e){
                //echo "something wrong code 500"; // not dev
                // dev
                echo "Query failed: " . $e->getMessage();
                
            }
            
            

        

    }

    public function checkPassword(){
        $credentials = $this->getCredentialsFromLoginName($this->data);
        
        if(password_verify($this->data["userpassword"], $credentials[0]["user_password"])){ 
                return true;
        }else{
            return false;
        }

        
    }

    public function loginError(){

        $_SESSION['login_error_message'] = "login not found";
        header("Location: /login");
        exit;
    }

    public function passwordError(){
        $_SESSION['password_error_message'] = "wrong password";
        header("Location: /login");
        exit;
    }


    


}