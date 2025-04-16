<?php
require_once '../config/Database.php';
require_once '../models/Batch.php';

class BatchController
{
    private $batch;

    public function __construct()
    {
        $database    = new Database();
        $db          = $database->getConnection();
        $this->batch = new Batch($db);
    }

    public function index()
    {
        $stmt    = $this->batch->read();
        $batches = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $batch_item = [
                "id"          => $id,
                "name"        => $name,
                "year"        => $year,
                "description" => $description,
                "created_at"  => $created_at,
            ];
            array_push($batches, $batch_item);
        }

        include_once '../views/batches/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->batch->name        = $_POST['name'];
            $this->batch->year        = $_POST['year'];
            $this->batch->description = $_POST['description'];

            if ($this->batch->create()) {
                header("Location: batch.php");
                exit();
            } else {
                $error = "Unable to create batch.";
                include_once '../views/batches/create.php';
            }
        } else {
            include_once '../views/batches/create.php';
        }
    }

    public function edit($id)
    {
        $this->batch->id = $id;
        $this->batch->readOne();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->batch->name        = $_POST['name'];
            $this->batch->year        = $_POST['year'];
            $this->batch->description = $_POST['description'];

            if ($this->batch->update()) {
                header("Location: batch.php");
                exit();
            } else {
                $error = "Unable to update batch.";
                include_once '../views/batches/edit.php';
            }
        } else {
            include_once '../views/batches/edit.php';
        }
    }

    public function delete($id)
    {
        $this->batch->id = $id;

        if ($this->batch->delete()) {
            header("Location: batch.php");
            exit();
        } else {
            $error = "Unable to delete batch.";
            $this->index();
        }
    }
}
