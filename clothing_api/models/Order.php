<?php

class Order
{
    private $conn;
    private $table = 'orders';

    public $id;
    public $customer_id;
    public $product_id;
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

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " SET customer_id= :customer_id, product_id= :product_id";

        $stmt = $this->conn->prepare($query);
                
        $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':product_id', $this->product_id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s .\n", $stmt->error);
        return false;
    }
}
