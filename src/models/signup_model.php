<?php

require_once("database.php");




class SignUping{
    public $data;

    public function __construct($post_data){
        $this->data = $post_data;
    }

    // check if user is already exists in db
    public function checkIfUserIsExists($loginName, $email): bool{

        $db = new DataBase();

        $stmt = $db->getConnection()->prepare("SELECT login_name, user_email FROM Users WHERE login_name = ? AND user_email = ?;");
        $stmt->execute([$loginName, $email]);

        $result = $stmt->fetchAll();

        if(empty($result)){
            return false;
        }else{
            return true;
        }

    }

    public function registrationOfUser($data){

        $db = new DataBase();
        if($this->checkIfUserIsExists($data["loginname"], $data['useremail']) == false){

            $stmt = $db->getConnection()->prepare("INSERT INTO Users (login_name, user_first_name,
                                                            user_last_name, user_email, user_gender, user_date_of_birth,
                                                            user_password, account_status, account_role)
                                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");

            try{
                $hashed_password = password_hash($data["userpassword"], PASSWORD_DEFAULT);
                $stmt->execute([$data["loginname"], $data["firstname"], $data["lastname"], $data["useremail"],
                                    $data["gender"], $data["dateofbirth"], $hashed_password, "active", "member"]);
                
                header('Location: /welcome');
                exit();
            }catch(PDOException $e){
                //echo "something wrong code 500"; // not dev
                // dev
                echo "Query failed: " . $e->getMessage();
                
            }
            
        }
    }
}