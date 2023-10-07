<?php

namespace App\Storage;

use PDO;
use PDOException;

class DB
{
    private $hostName = "localhost";
    private $databaseName = "pdoexample";
    private $userName = "root";
    private $password = "";
    public $conn;
    public function __construct()
    {
        try {
            $pdo = $this->conn = new PDO("mysql:host=$this->hostName;dbname=$this->databaseName", $this->userName, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function createTable($sql)
    {
        try {
            $this->conn->exec($sql);
        } catch (PDOException $e) {
            echo  $e->getMessage();
        }
    }
}
