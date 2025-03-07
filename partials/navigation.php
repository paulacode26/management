<?php
if (!function_exists('setActiveClass')) {
    function setActiveClass($page)
    {
        return strpos($_SERVER['PHP_SELF'], $page) !== false ? 'active' : '';
    }
}

$basePath = '/FS2/studentmanagement/';
?>

<nav>
    <ul>
        <!-- Home link with active class if the current page is 'index.php' -->
        <li><a class="<?php echo setActiveClass('index.php'); ?>" href="<?php echo $basePath; ?>index.php">Home</a></li>

        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <!-- Display Dashboard and Logout links if the user is logged in -->
            <li><a class="<?php echo setActiveClass('StudentView.php'); ?>" href="<?php echo $basePath; ?>view/StudentView.php">Dashboard</a></li>
            <li><a class="<?php echo setActiveClass('Logout.php'); ?>" href="<?php echo $basePath; ?>view/Logout.php">Logout</a></li>
            <!-- Display username -->
            <li style="color: white;">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</li>
            <?php else: ?>
            <!-- Display Register and Login links if the user is NOT logged in -->
            <li><a class="<?php echo setActiveClass('Register.php'); ?>" href="<?php echo $basePath; ?>view/Register.php">Register</a></li>
            <li><a class="<?php echo setActiveClass('Login.php'); ?>" href="<?php echo $basePath; ?>view/Login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>


