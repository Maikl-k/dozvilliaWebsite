<?php

require_once "validator.php";

class CrRecValidator extends Validator{

    public static $fields = ["name-of-rec", "type-of-rec", "release-date", "item-image", "descr-of-rec", "why-item-good"];

    public function validateForm(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                return $this->addError($field, "one of field not in form");
                
            }
        }

        $this->validateNameOfRec();
        $this->validateTypeOfRec();
        $this->validateReleaseDate();
        $this->validateItemImage();
        $this->validateDescrOfRec();
        $this->validateWhyItemGood();
        return $this->errors;

    }


    public function validateNameOfRec(){

        $nameOfRecMaxLength = 60;
        $nameOfRecMinLength = 2;

        $nameOfRec = htmlspecialchars($this->data['name-of-rec']);

        if(empty($nameOfRec)){
            $this->addError("name-of-rec","title is required");
        }

        if(strlen($nameOfRec) > $nameOfRecMaxLength || strlen($nameOfRec) < $nameOfRecMinLength){
            $this->addError("name-of-rec", "valid length is from ". $nameOfRecMinLength ." to " . $nameOfRecMaxLength);
        }


    }

    public function validateTypeOfRec(){

        $validTypes = ["movie", "book", "serial", "podcast"];

        $typeOfRec = htmlspecialchars($this->data['type-of-rec']);

        if(empty($typeOfRec)){
            $this->addError("type-of-rec", "section of recodendation is required");
        }

        if(!in_array($typeOfRec, $validTypes)){
            $this->addError("type-of-rec", "it is ton valid optinon please select from valid options");
        }

    }



    public function validateReleaseDate(){

        $inputDate = $this->data['release-date'];
        $dateFormat = 'Y-m-d';

        $now = new DateTime();
        $todaydate = $now->format($dateFormat);

        $dateObject = DateTime::createFromFormat($dateFormat, $inputDate);

        if(!$dateObject && !$dateObject->format($dateFormat) === $inputDate){
            $this->addError("release-date", "not valid format of date. valid is YYYY-MM-DD");
        }

        if($inputDate > $todaydate){
            $this->addError("release-date" ,"release date of released can not be in future if recomedation item is exists");
        }



    }

    public function validateItemImage(){

        $inputImage = $_FILES['item-image'];

        $maxSizeImageMB = 1;
        $inputImageSize = $inputImage['size'] / 1024 / 1024; // form bytes to megabytes

        if($inputImageSize > $maxSizeImageMB){
            $this->addError("item-image", "to large image 1 MB is max size");
        }

    }

    public function validateDescrOfRec(){

        $itemDescrMaxLength = 2000;
        $itemDEscrMinLength = 3;


        $itemDescr = htmlspecialchars($this->data["descr-of-rec"]);

        if(empty($itemDescr)){
            $this->addError("desct-of-rec", "description is required");
        }

        if(strlen($itemDescr) > $itemDescrMaxLength || strlen($itemDescr) < $itemDEscrMinLength){
            $this->addError("descr-of-rec", "valid length for description is from " . $itemDEscrMinLength . " to " . $itemDescrMaxLength);
        }

    }

    public function validateWhyItemGood(){


        $WhyItemGoodMaxLength = 2000;
        $whyItemGoodMinLength = 3;

        $whyItemGood = htmlspecialchars($this->data['why-item-good']);

        if(empty($whyItemGood)){
            $this->addError("why-item-good", "why item is good field is required");
        }

        if(strlen($whyItemGood) > $WhyItemGoodMaxLength || strlen($whyItemGood) < $whyItemGoodMinLength){
            $this->addError("why-item-good", "valid length for why item is good field is from ". $whyItemGoodMinLength . " to " . $WhyItemGoodMaxLength);
        }
    }

}