<?php

require_once '../config/Database.php';
require_once '../models/Division.php';

class DivisionController
{
    private $division;

    public function __construct()
    {
        $database       = new Database();
        $db             = $database->getConnection();
        $this->division = new Division($db);
    }

    public function index()
    {
        $stmt      = $this->division->read();
        $divisions = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $division_item = [
                'id'          => $id,
                'name'        => $name,
                'description' => $description,
                'created_at'  => $created_at,
            ];
            array_push($divisions, $division_item);
        }

        include_once '../views/divisions/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->division->name        = $_POST['name'];
            $this->division->description = $_POST['description'];

            if ($this->division->create()) {
                header('Location: division.php');
                exit();
            } else {
                $error = "Unable to create division.";
                include_once "../views/divisions/create.php";
            }
        } else {
            include_once "../views/divisions/create.php";
        }
    }

    public function edit($id)
    {
        $this->division->id = $id;
        $this->division->readOne();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->division->name        = $_POST['name'];
            $this->division->description = $_POST['description'];

            if ($this->division->update()) {
                header('Location: division.php');
                exit();

            } else {
                $error = "Unable to update division.";
                include_once "../views/divisions/edit.php";
            }
        } else {
            include_once "../views/divisions/edit.php";
        }
    }

    public function delete($id)
    {
        $this->division->id = $id;

        if ($this->division->delete()) {
            header('Location: division.php');
            exit();
        } else {
            $error = "Unable to delete division";
            $this->index();
        }
    }
}
