<?php 

class Customer{
    private $conn;
    private $table = 'customers';

    public $id;
    public $name;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT * from ' . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create(){
        $query = "INSERT INTO " . $this->table . " SET name= :name";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $stmt->bindParam(':name', $this->name);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s .\n", $stmt->error);
        return false;
    }

}