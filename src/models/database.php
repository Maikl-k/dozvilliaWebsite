<?php
class DataBase {
    private static $instance = null;
    private $conn;

    private $host = "localhost";
    private $user = "root";
    private $password = "1q2w3e4r5t!Q";
    private $databaseName = "dozvilliadb";

    public function __construct(){

        $dns = 'mysql:host=' . $this->host . ";dbname=" . $this->databaseName;
        $options = [
            PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->conn = new PDO($dns, $this->user, $this->password, $options);
        } catch (PDOException $e){
            die("connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance(){

        if(!self::$instance){
            self::$instance = new DataBase();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->conn;
    }

}