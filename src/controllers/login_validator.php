<?php

require_once "validator.php";

class LoginValidator extends Validator{

    public static $fields = ["loginname", "userpassword"];

    public function validateForm(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                return $this->addError($field, "one of field not in form");
                
            }
        }

        $this->validateLoginname();
        $this->validatePasswords();
        return $this->errors;

    }

    public function validatePasswords(){

        $maxLengthPassword = 64;
        $minLengthPassword = 8;

        $password = htmlspecialchars(trim($this->data["userpassword"]));

        if(empty($password)){
            $this->addError("userpassword", "password is required");
        }elseif(strlen($password) > $maxLengthPassword){
            $this->addError("userpassword", "to long password maximum ". $maxLengthPassword ." chars");
        }elseif(strlen($password) < $minLengthPassword){
            $this->addError("userpassword", " to short password minimum ". $minLengthPassword ." chars");
        }
    }
    
}