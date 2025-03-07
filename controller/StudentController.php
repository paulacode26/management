<?php
include "../model/Student.php";
include_once "../config/Database.php";

class StudentController {
    private $studentModel;

    public function __construct(){
        $database = new Database();
        $db = $database->connect();
        $this->studentModel = new Student($db);
    }

    public function addStudent($student_name, $email_address){
        if (!User::isLoggedIn()) {
            $_SESSION["message"] = "Please log in to add a student!";
            $_SESSION["message_type"] = "error";
            header("Location: Login.php");
            exit;
        }

        $this->studentModel->student_name = $student_name;
        $this->studentModel->email_address = $email_address;
        $result = $this->studentModel->create();

        if($result){
            $_SESSION["message"] = "Student Added Successfully";
            $_SESSION["message_type"] = "success";
        } else {
            $_SESSION["message"] = "Failed to Add Student";
            $_SESSION["message_type"] = "error";
        }
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }

    public function deleteStudent($id){
        if (!User::isLoggedIn()) {
            $_SESSION["message"] = "Please log in to delete a student!";
            $_SESSION["message_type"] = "error";
            header("Location: view/Login.php");
            exit;
        }

        $this->studentModel->student_id = $id;
        $result = $this->studentModel->delete();

        if($result){
            $_SESSION["message"] = "Student deleted successfully";
            $_SESSION["message_type"] = "success";
        } else {
            $_SESSION["message"] = "Failed to delete student";
            $_SESSION["message_type"] = "error";
        }
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }

    public function getStudents() {
        return $this->studentModel->read();
    }
}
?>

