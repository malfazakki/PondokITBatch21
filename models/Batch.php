<?php
class Batch
{
    private $conn;
    private $table_name = "batches";

    public $id;
    public $name;
    public $year;
    public $description;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create batch
    public function create()
    {
        $query = "INSERT INTO {$this->table_name} SET name=:name, year=:year, description=:description, created_at=:created_at";
        $stmt  = $this->conn->prepare($query);

        // Sanitize inputs
        $this->name        = htmlspecialchars(strip_tags($this->name));
        $this->year        = htmlspecialchars(strip_tags($this->year));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->created_at  = date('Y-m-d H:i:s');

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":created_at", $this->created_at);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read all batches
    public function read()
    {
        $query = "SELECT * FROM {$this->table_name} ORDER BY year DESC";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read single batch
    public function readOne()
    {
        $query = "SELECT * FROM {$this->table_name} WHERE id = ? LIMIT 0,1";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->name        = $row['name'];
            $this->year        = $row['year'];
            $this->description = $row['description'];
            $this->created_at  = $row['created_at'];
            return true;
        }
        return false;
    }

    // Update batch
    public function update()
    {
        $query = "UPDATE {$this->table_name} SET name=:name, year=:year, description=:description WHERE id=:id";
        $stmt  = $this->conn->prepare($query);

        // Sanitize inputs
        $this->name        = htmlspecialchars(strip_tags($this->name));
        $this->year        = htmlspecialchars(strip_tags($this->year));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id          = htmlspecialchars(strip_tags($this->id));

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":id", $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete batch
    public function delete()
    {
        $query = "DELETE FROM {$this->table_name} WHERE id = ?";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
