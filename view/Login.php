<?php
session_start();
include_once "../partials/header.php";
include_once "../controller/UserController.php"; 
include_once "../model/User.php";
include_once "../partials/navigation.php";

if(User::isLoggedIn()){
    header("Location: StudentView.php");
    exit;
}

$userController = new UserController();

if (isset($_POST['login'])) {
    $userController->loginUser($_POST['email'], $_POST['password']);
    header("Location: StudentView.php");
    exit; 
}
?>
<div class="container">
    <h1>Login</h1>
    <form method="POST">
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter your Email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>
            <button type="submit" name="login">Login</button>
    </form>
</div>
<?php
    include "../partials/footer.php";
?>    

