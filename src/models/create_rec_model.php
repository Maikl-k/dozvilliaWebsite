<?php

require_once "database.php";

class CreateRecomendation{

    public $data;

    public function __construct($createRecData){
        $this->data = $createRecData;
    }


    public function getItemInfoIfRecIsExists($nameOfRec){

        $db = new DataBase();
        $searchTitleOfRecSql = "SELECT creator_id, item_title, item_section, item_release_date, item_description, why_item_good FROM Items WHERE item_title = ?;";
        $stmt = $db->getConnection()->prepare($searchTitleOfRecSql);
        $stmt->execute([$nameOfRec]);

        $itemInfo = $stmt->fetchAll();

        if(empty($itemInfo)){
            return false;
        }else{
            return $itemInfo;
        }

    }





    public function addRecToDatabase($data){

        $db = new DataBase();
        require_once "session_model.php";
        $session = new SessionManager();

        $addDataToDBSql = "INSERT INTO Items (creator_id, item_title, item_section, 
                            item_release_date, item_image, item_description, why_item_good) VALUES (?, ?, ?, ?, ?, ?, ?);";
        
        $stmt = $db->getConnection()->prepare($addDataToDBSql);

        $stmt->execute([$_SESSION['userID'], $data['name-of-rec'], $data['type-of-rec'],
                        $data['release-date'], $_FILES['item-image']["tmp_name"], $data['descr-of-rec'],
                        $data['why-item-good']]);


    }


    public function RecExistsStatus(){

        require_once "session_model.php";
        $session = new SessionManager();
        $message;

        if($this->getItemInfoIfRecIsExists($this->data['name-of-rec']) == false ){
            $message = "on this website this is completely new recomendation";
        }else{
            $message = "somebody added this before";
        }

        $session->set("after-create_rec_message", $message);
    }

}