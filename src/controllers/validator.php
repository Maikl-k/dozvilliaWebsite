<?php

class Validator{

    public $data;
    public $errors = [];
    public static $fields = ["loginname", "firstname", "lastname", "useremail", "gender", "dateofbitrh", "userpassword", "confpassword"];

    
    public function __construct($post_data){
        $this->data = $post_data;
    }


    public function addError($key, $error){
        $this->errors[$key] = $error;
    }

    public function validateForm(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                return $this->addError($field, "one of field not in form");
                
            }
        }
        
        $this->validateLoginname();
        $this->validateFirstname();
        $this->validateLastname();
        $this->validateEmail();
        $this->validategender();
        $this->validateDateOfBirth();
        $this->validatePasswords();
        return $this->errors;
    }


    public function validateLoginname(){

        $maxLengthLoginName = 30;
        $minLengthLoginName = 3;

        $value = htmlspecialchars(trim($this->data['loginname']));

        if(empty($value)){
            $this->addError('loginname','login name is required');
        } elseif(strlen($value) > $maxLengthLoginName){
            $this->addError('loginname','to long login name, maximum length ' . $maxLengthLoginName .' chars');
        } elseif(strlen($value) < $minLengthLoginName){
            $this->addError("loginname", "to short login name minimum " . $minLengthLoginName . " chars");
        }
    }


    public function validateFirstname(){

        $maxLengthFirstName = 50;
        $minLengthFirstName = 2;
        $digitPattern = '/\d+/';

        $value = htmlspecialchars($this->data["firstname"]);

        if(trim(strlen($value)) == 0){
            $this->addError("firstname","first name is required");
        } elseif (strlen($value) > $maxLengthFirstName){
            $this->addError("firstname", "to long first name maximum " . $maxLengthFirstName . " chars");
        }elseif(strlen($value) < $minLengthFirstName){
            $this->addError("firstname", "to short first name minimum ". $minLengthFirstName . " chars");
        }elseif(preg_match($digitPattern, $value)){
            $this->addError("firstname", "in first name no numbers");
        }
    }

    public function validateLastname(){

        $maxLengthLastName = 50;
        $minLengthLastName = 2;

        $digitPattern = '/\d+/';

        $value = htmlspecialchars($this->data['lastname']);

        if(trim(strlen($value)) == 0){
            $this->addError('lastname', 'last name is required');
        }elseif (strlen($value) > $maxLengthLastName){
            $this->addError("lastname","to long last name maxmum ". $maxLengthLastName . " chars");
        }elseif(strlen($value) < $minLengthLastName){
            $this->addError("lastaname", "to short last name minimum " . $minLengthLastName. " chars");
        }elseif(preg_match($digitPattern, $value)){
            $this->addError("lastname", "in last name no mnumbers");
        }
    }

    public function validateEmail(){

        $maxLengthEmail = 254;
        $minLengthEmail = 4;

        $value = htmlspecialchars(trim($this->data['useremail']));

        if(strlen($value) == 0){
            $this->addError('useremail', 'email is required');
        }elseif (strlen($value) > $maxLengthEmail){
            $this->addError("useremail", "to long email maximum " . $maxLengthEmail . " chars");
        }elseif(strlen($value) < $minLengthEmail){
            $this->addError("useremail", "to short email minimum ". $minLengthEmail ." chars");
        }elseif(filter_var($value, FILTER_VALIDATE_EMAIL) === false){
            $this->addError("useremail", "not valid email");
        }
    }



    public function validategender(){

        $value = htmlspecialchars($this->data['gender']);

        if($value == null){
            $this->addError('gneder','gender is required');
        }elseif(strlen($value) > 1){
            $this->addError('gender', "you can select only one gender");
        }
    }


    public function validateDateOfBirth(){

        $value = htmlspecialchars($this->data['dateofbirth']);
        $dateFormat = 'Y-m-d';
        $minValidDateStr = '1826-01-01';

        $dateOfBirthOdj = DateTime::createFromFormat($dateFormat, $value);

        if(!$dateOfBirthOdj && $dateOfBirthOdj->format($dateFormat) !== $value){
            $this->addError("date0fbirth", "invalid format for date of birth");
        }

        $minValidDate = new DateTime($minValidDateStr);
        $UserDateOfBirthDateObj = new DateTime($value);

        if(!isset($UserDateOfBirth)){
            $this->addError("dateofbirth", "date of birth is required");
        }elseif($UserDateOfBirthDateObj < $minValidDate){
            $this->addError("dateofbirth", "to early date, valid date of birth must be after ". $minValidDate->format($dateFormat));
        }


    }


    public function validatePasswords(){

        $maxLengthPassword = 64;
        $minLengthPassword = 8;

        $password = htmlspecialchars(trim($this->data["userpassword"]));
        $confpassword = htmlspecialchars(trim($this->data["confpassword"]));

        if(empty($password)){
            $this->addError("userpassword", "password is required");
        }elseif(empty($confpassword)){
            $this->addError("confpassword", "confirm password is required");
        }elseif(strlen($password) > $maxLengthPassword){
            $this->addError("userpassword", "to long password maximum ". $maxLengthPassword ." chars");
        }elseif(strlen($password) < $minLengthPassword){
            $this->addError("userpassword", " to short password minimum ". $minLengthPassword ." chars");
        }


        if($password != $confpassword){
            $this->addError("userpassword", "password and confirm password must be the same");
        }
    }

}