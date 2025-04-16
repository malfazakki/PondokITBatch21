<?php

class Student
{
    private $conn;
    private $table_name = "students";

    public $id;
    public $name;
    public $gender;
    public $address;
    public $phone;
    public $email;
    public $batch_id;
    public $division_id;
    public $created_at;

    // Property for joining with other tables
    public $batch_name;
    public $division_name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create student
    public function create()
    {
        $query = "INSERT INTO {$this->table_name}
                  SET name=:name, gender=:gender, address=:address, phone=:phone,
                      email=:email, batch_id=:batch_id, division_id=:division_id,
                      created_at=:created_at";

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->name        = htmlspecialchars(strip_tags($this->name));
        $this->gender      = htmlspecialchars(strip_tags($this->gender));
        $this->address     = htmlspecialchars(strip_tags($this->address));
        $this->phone       = htmlspecialchars(strip_tags($this->phone));
        $this->email       = htmlspecialchars(strip_tags($this->email));
        $this->batch_id    = htmlspecialchars(strip_tags($this->batch_id));
        $this->division_id = htmlspecialchars(strip_tags($this->division_id));
        $this->created_at  = date('Y-m-d H:i:s');

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":batch_id", $this->batch_id);
        $stmt->bindParam(":division_id", $this->division_id);
        $stmt->bindParam(":created_at", $this->created_at);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read all students with batch and division information
    public function read()
    {
        $query = "SELECT s.id, s.name, s.gender, s.address, s.phone, s.email,
                         s.batch_id, b.name as batch_name,
                         s.division_id, d.name as division_name,
                         s.created_at
                  FROM {$this->table_name} s
                  LEFT JOIN batches b ON s.batch_id = b.id
                  LEFT JOIN divisions d on s.division_id = d.id
                  ORDER BY s.name ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Read single student
    public function readOne()
    {
        $query = "SELECT s.id, s.name, s.gender, s.address, s.phone, s.email,
                         s.batch_id, b.name as batch_name,
                         s.division_id, d.name as division_name,
                         s.created_at
                  FROM {$this->table_name} s
                  LEFT JOIN batches b ON s.batch_id = b.id
                  LEFT JOIN divisions d on s.division_id = d.id
                  WHERE s.id = ?
                  LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->name          = $row['name'];
            $this->gender        = $row['gender'];
            $this->address       = $row['address'];
            $this->phone         = $row['phone'];
            $this->email         = $row['email'];
            $this->batch_id      = $row['batch_id'];
            $this->batch_name    = $row['batch_name'];
            $this->division_id   = $row['division_id'];
            $this->division_name = $row['division_name'];
            $this->created_at    = $row['created_at'];
            return true;
        }
        return false;

    }

    // Update student
    public function update()
    {
        $query = "UPDATE {$this->table_name}
                  SET name=:name, gender=:gender, address=:address, phone=:phone,
                      email=:email, batch_id=:batch_id, division_id=:division_id
                  WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->name        = htmlspecialchars(strip_tags($this->name));
        $this->gender      = htmlspecialchars(strip_tags($this->gender));
        $this->address     = htmlspecialchars(strip_tags($this->address));
        $this->phone       = htmlspecialchars(strip_tags($this->phone));
        $this->email       = htmlspecialchars(strip_tags($this->email));
        $this->batch_id    = htmlspecialchars(strip_tags($this->batch_id));
        $this->division_id = htmlspecialchars(strip_tags($this->division_id));
        $this->id          = htmlspecialchars(strip_tags($this->id));

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":batch_id", $this->batch_id);
        $stmt->bindParam(":division_id", $this->division_id);
        $stmt->bindParam(":id", $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete student
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
