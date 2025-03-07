<?php
session_start();
include_once "../partials/header.php";
include_once "../model/User.php"; 
include_once "../controller/UserController.php"; 
include_once "../partials/navigation.php";

if (User::isLoggedIn()) {
    header("Location: StudentView.php");
    exit;
}

$userController = new UserController();

if (isset($_POST['register'])) {
    $userController->registerUser($_POST['username'], $_POST['email'], $_POST['password']);
}

?>
<div class="container">
    <h1>Register</h1>    
    <form method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Enter your Username" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter your Email" required>
        </div>
        <div>
            <label for="email">Password:</label>
            <input type="password" name="password" placeholder="Enter your Password" required>
        </div>
        <button type="submit" name="register">Register</button>
    </form>
</div>
<?php
    include "../partials/footer.php";
?>  
