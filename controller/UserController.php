<?php
include_once "../model/User.php";
include_once "../config/Database.php";

class UserController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->userModel = new User($db);
    }

    public function registerUser($username, $email, $password) {
        $this->userModel->username = $username;
        $this->userModel->email = $email;
        $this->userModel->password = password_hash($password, PASSWORD_BCRYPT);
    
        $result = $this->userModel->register();
    
        if ($result) {
            $this->userModel->email = $email;
            $this->userModel->password = $password;
            $user = $this->userModel->login(); 
    
            if ($user) {
                User::setUserSession($user); 
                $_SESSION["message"] = "Registration Successful!";
                $_SESSION["message_type"] = "success";
                header("Location: StudentView.php"); 
                exit;
            } else {
                $_SESSION["message"] = "Login Failed After Registration!";
                $_SESSION["message_type"] = "error";
                header("Location: Register.php"); 
                exit;
            }
        } else {
            $_SESSION["message"] = "Registration Failed!";
            $_SESSION["message_type"] = "error";
            header("Location: Register.php"); 
            exit;
        }
    }
    
    public function loginUser($email, $password) {
        $this->userModel->email = $email;
        $this->userModel->password = $password;

        $user = $this->userModel->login();

        if ($user) {
            User::setUserSession($user); 
            $_SESSION["message"] = "Login Successful!";
            $_SESSION["message_type"] = "success";
            header("Location: StudentView.php");
            exit;
        } else {
            $_SESSION["message"] = "Invalid login credentials!";
            $_SESSION["message_type"] = "error";
            header("Location: Login.php");
            exit;
        }
    }

    public function logoutUser() {
        session_unset();
        session_destroy();
        header("Location: view/Login.php");
        exit;
    }
}
?>
