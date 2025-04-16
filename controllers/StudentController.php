<?php
require_once '../config/Database.php';
require_once '../models/Student.php';
require_once '../models/Batch.php';
require_once '../models/Division.php';

class StudentController
{
    private $student;
    private $batch;
    private $division;

    public function __construct()
    {
        $database       = new Database();
        $db             = $database->getConnection();
        $this->student  = new Student($db);
        $this->batch    = new Batch($db);
        $this->division = new Division($db);
    }

    public function index()
    {
        $stmt     = $this->student->read();
        $students = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $student_item = [
                "id"            => $id,
                "name"          => $name,
                "gender"        => $gender,
                "address"       => $address,
                "phone"         => $phone,
                "email"         => $email,
                "batch_id"      => $batch_id,
                "batch_name"    => $batch_name,
                "division_id"   => $division_id,
                "division_name" => $division_name,
                "created_at"    => $created_at,
            ];
            array_push($students, $student_item);
        }

        include_once '../views/students/index.php';
    }

    public function create()
    {
        // Get batches and divisions for dropdown
        $batch_stmt    = $this->batch->read();
        $division_stmt = $this->division->read();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->student->name        = $_POST['name'];
            $this->student->gender      = $_POST['gender'];
            $this->student->address     = $_POST['address'];
            $this->student->phone       = $_POST['phone'];
            $this->student->email       = $_POST['email'];
            $this->student->batch_id    = $_POST['batch_id'];
            $this->student->division_id = $_POST['division_id'];

            if ($this->student->create()) {
                header("Location: student.php");
                exit();
            } else {
                $error = "Unable to create student.";
                include_once '../views/students/create.php';
            }
        } else {
            include_once '../views/students/create.php';
        }
    }

    public function edit($id)
    {
        $this->student->id = $id;
        $this->student->readOne();

        // Get batches and divisions for dropdown
        $batch_stmt    = $this->batch->read();
        $division_stmt = $this->division->read();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->student->name        = $_POST['name'];
            $this->student->gender      = $_POST['gender'];
            $this->student->address     = $_POST['address'];
            $this->student->phone       = $_POST['phone'];
            $this->student->email       = $_POST['email'];
            $this->student->batch_id    = $_POST['batch_id'];
            $this->student->division_id = $_POST['division_id'];

            if ($this->student->update()) {
                header("Location: student.php");
                exit();
            } else {
                $error = "Unable to update student.";
                include_once '../views/students/edit.php';
            }
        } else {
            include_once '../views/students/edit.php';
        }
    }

    public function delete($id)
    {
        $this->student->id = $id;

        if ($this->student->delete()) {
            header("Location: student.php");
            exit();
        } else {
            $error = "Unable to delete student.";
            $this->index();
        }
    }
}
