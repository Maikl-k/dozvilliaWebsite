<?php

require_once "database.php";

$database = new DataBase();

$itemTableSql = "CREATE TABLE IF NOT EXISTS Items(
                    item_id INT AUTO_INCREMENT,
                    creator_id INT NOT NULL,
                    item_image blob NOT NULL,
                    item_title VARCHAR(60) NOT NULL,
                    item_section ENUM('movie', 'book', 'serial', 'podcast') NOT NULL,
                    item_release_date DATE NOT NULL,
                    item_description VARCHAR(2000) NOT NULL,
                    item_create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    item_change_date DATETIME,
                    why_item_good VARCHAR(2000) NOT NULL,
                    Primary key (item_id, creator_id),
                    foreign key (creator_id) references Users(user_id)
                    );
                    ";

$stmt = $database->getConnection()->prepare($itemTableSql);

$stmt->execute();