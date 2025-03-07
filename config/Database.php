<?php

class Database {
    private $host = "localhost";
    private $db_name = "studentmanagement";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connect() {
        // Create a new connection
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        // Check the connection
        if ($this->conn->connect_error) {
            // Output the error and terminate the script
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
?>
