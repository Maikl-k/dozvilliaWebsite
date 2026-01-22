<?php
require_once("database.php");

$database = new DataBase();



$stmt1 = $database->getConnection()->prepare('CREATE TABLE IF NOT EXISTS Users (
                                            user_id INT AUTO_INCREMENT PRIMARY KEY,
                                            user_profile_image BLOB,
                                            login_name VARCHAR(30) UNIQUE NOT NULL,
                                            user_first_name VARCHAR(50) NOT NULL,
                                            user_last_name VARCHAR(50) NOT NULL,
                                            user_email VARCHAR(254) UNIQUE NOT NULL,
                                            user_gender ENUM("male" , "female"),
                                            user_date_of_birth DATE NOT NULL,
                                            user_password VARCHAR(64) NOT NULL,
                                            user_date_of_creating_account TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                            account_status ENUM("active", "inactive", "closed", "archived", "suspended") NOT NULL,
                                            account_role ENUM("member", "editor", "admin") NOT NULL
                                            );
                                            ');

$stmt1->execute();

