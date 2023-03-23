<?php

class Database
{
    //DB params
    private $host = 'localhost';
    private $db_name = 'clothing';
    private $db_username = 'root';
    private $db_password = '';
    private $conn;

    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->db_username, $this->db_password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "connection error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
