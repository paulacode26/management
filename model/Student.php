<?php
class Student {
    private $conn;
    public $student_name;
    public $student_id;
    public $email_address;

    public function __construct($db) {
        $this->conn = $db;
    }

    
    public function read() {
        $query = "SELECT * FROM students";
        return $this->conn->query($query);
    }

    public function create() {
        $query = "INSERT INTO students (student_name, email_address) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $this->student_name, $this->email_address);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM students WHERE student_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->student_id);
        return $stmt->execute();
    }
}
?>
