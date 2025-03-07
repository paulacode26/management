<?php
session_start();
include_once "../partials/header.php";
include_once "../model/User.php"; 
include_once "../controller/StudentController.php";  
include_once "../model/Student.php";               
include_once "../partials/navigation.php";

// Check if the user is logged in, if not redirect to login page
if (!User::isLoggedIn()) {
    header("Location: Login.php");
    exit;
}

$studentController = new StudentController();

if (isset($_POST['add_student'])) {
    $studentController->addStudent($_POST['student_name'], $_POST['email_address']);
}

if (isset($_POST['delete_student'])) {
    $studentController->deleteStudent($_POST['student_id']);
}

// Fetch the students list via controller
$students = $studentController->getStudents();
?>
<div class="container1">
<div class="add-student-section">
    <!-- Add Student Form -->
    <h2>Add Student</h2>
    <form method="POST" action="">
        <div>
            <label for="student_name">Student Name:</label>
            <input type="text" name="student_name" placeholder="Student Name" required>
        </div>
        <div>
            <label for="email_address">Email Address:</label>
            <input type="email" name="email_address" placeholder="Email Address" required>
        </div>
        <button type="submit" name="add_student">Add Student</button>
    </form>
</div>

<div class="student-list">
    <?php if ($students && $students->num_rows > 0): ?>
        <?php while($student = $students->fetch_assoc()): ?>
            <div class="student-card">
                <div class="student-info">
                    <label for="student_id">ID:</label>
                    <h4><?php echo $student['student_id']; ?></h4>
                </div>
                <div class="student-info">
                    <label for="student_name">Name:</label>
                    <h4><?php echo $student['student_name']; ?></h4>
                </div>
                <div class="student-info">
                    <label for="email_address">Email:</label>
                    <p><?php echo $student['email_address']; ?></p>
                </div>
                <form class="form"method="POST" style="display:inline;">
                    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                    <button type="submit" name="delete_student">Delete</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No students found.</p>
    <?php endif; ?>
</div>
<?php
    include "../partials/footer.php";
?>  
