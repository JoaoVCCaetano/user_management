<?php

namespace App\Database;

use PDO;
use PDOException;

class Database {
    private $host;
    private $dbname;
    private $user;
    private $pass;
    private $conn;

    public function __construct($database) {

        $config = require '../src/config/config.php';

        $this->host = $config[$database]['host'];
        $this->dbname = $config[$database]['dbname'];
        $this->user = $config[$database]['user'];
        $this->pass = $config[$database]['pass'];
    }

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die( 'Connection failed: ' . $e->getMessage());
        }
    }
}
