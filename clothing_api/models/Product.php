<?php

class Product
{
    private $conn;
    private $table = 'products';

    public $id;
    public $name;
    public $description;
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

    public function read_single()
    {
        $query = 'SELECT * from ' . $this->table . ' WHERE id = ? LIMIT 0,1 ';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row != null) {
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->created_at = $row['created_at'];
        }
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " SET name= :name, description= :description";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);

        if($stmt->execute() ){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);
        return false;
    }
}
