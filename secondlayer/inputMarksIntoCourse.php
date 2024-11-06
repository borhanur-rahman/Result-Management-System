<?php 
session_start();
require '../db.php';

$year = "";
$courseId = "";
$submitedStudents = [];
$notSubmitedStudents = [];
$status = "";

// Retrieve values from POST and GET requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = $_POST['course_year'];
    $courseId = $_POST['course_id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['marks'], $_GET['student_id'], $_GET['year'], $_GET['course_id'])) {
    $year = $_GET['year'];
    $courseId = $_GET['course_id'];
    $student_id = $_GET['student_id'];
    $mark = $_GET['marks'];

    // Validate mark input and update if valid
    if (is_numeric($mark) && (int)$mark <= 100 && (int)$mark >= 0) {
        if ((int)$year === 2) {
            // Securely update mark for second year students
            $stmt = $pdo->prepare("UPDATE secondyear SET $courseId = :marks WHERE s_id = :id");
            $stmt->bindParam(':marks', $mark, PDO::PARAM_INT);
            $stmt->bindParam(':id', $student_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $status = "success";
            } else {
                $status = "error";
            }
        }
         else if ((int)$year === 1) {
            // Securely update mark for second year students
            $stmt = $pdo->prepare("UPDATE firstyear SET $courseId = :marks WHERE s_id = :id");
            $stmt->bindParam(':marks', $mark, PDO::PARAM_INT);
            $stmt->bindParam(':id', $student_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $status = "success";
            } else {
                $status = "error";
            }
        }
        else if ((int)$year === 3) {
            // Securely update mark for second year students
            $stmt = $pdo->prepare("UPDATE thirdyear SET $courseId = :marks WHERE s_id = :id");
            $stmt->bindParam(':marks', $mark, PDO::PARAM_INT);
            $stmt->bindParam(':id', $student_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $status = "success";
            } else {
                $status = "error";
            }
        }
        else if ((int)$year === 4) {
            // Securely update mark for second year students
            $stmt = $pdo->prepare("UPDATE forthyear SET $courseId = :marks WHERE s_id = :id");
            $stmt->bindParam(':marks', $mark, PDO::PARAM_INT);
            $stmt->bindParam(':id', $student_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $status = "success";
            } else {
                $status = "error";
            }
        }
        else{

        }
    } else {
        $status = "Invalid mark value";
    }
}

// Fetch students with and without submitted marks
if ((int)$year === 2) {
    // Students with marks
    $sql = "SELECT a.s_name, a.s_id, b.$courseId FROM student AS a 
            JOIN secondyear AS b ON a.s_id = b.s_id 
            WHERE b.$courseId IS NOT NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $submitedStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Students without marks
    $sql = "SELECT a.s_name, a.s_id, b.$courseId FROM student AS a 
            JOIN secondyear AS b ON a.s_id = b.s_id 
            WHERE b.$courseId IS NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $notSubmitedStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else if ((int)$year === 1) {
    // Students with marks
    $sql = "SELECT a.s_name, a.s_id, b.$courseId FROM student AS a 
            JOIN firstyear AS b ON a.s_id = b.s_id 
            WHERE b.$courseId IS NOT NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $submitedStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Students without marks
    $sql = "SELECT a.s_name, a.s_id, b.$courseId FROM student AS a 
            JOIN firstyear AS b ON a.s_id = b.s_id 
            WHERE b.$courseId IS NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $notSubmitedStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else if ((int)$year === 3) {
    // Students with marks
    $sql = "SELECT a.s_name, a.s_id, b.$courseId FROM student AS a 
            JOIN thirdyear AS b ON a.s_id = b.s_id 
            WHERE b.$courseId IS NOT NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $submitedStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Students without marks
    $sql = "SELECT a.s_name, a.s_id, b.$courseId FROM student AS a 
            JOIN thirdyear AS b ON a.s_id = b.s_id 
            WHERE b.$courseId IS NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $notSubmitedStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else if ((int)$year === 4) {
    // Students with marks
    $sql = "SELECT a.s_name, a.s_id, b.$courseId FROM student AS a 
            JOIN forthyear AS b ON a.s_id = b.s_id 
            WHERE b.$courseId IS NOT NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $submitedStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Students without marks
    $sql = "SELECT a.s_name, a.s_id, b.$courseId FROM student AS a 
            JOIN forthyear AS b ON a.s_id = b.s_id 
            WHERE b.$courseId IS NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $notSubmitedStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Marks</title>
    <link rel="stylesheet" href="../style/teacherView.css">
    <style>
        .edit-btn, .save-btn {
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
        }
        .edit-input {
            display: none; /* Initially hidden */
            width: 80px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="head">
        <h3>The Students Whose Marks Have Been Entered</h3>
        <?php if ($status): ?>
            <p>Status: <?php echo htmlspecialchars($status); ?></p>
        <?php endif; ?>
    </div>

    <!-- Table for students who have submitted marks -->
    <div>
        <table>
            <thead>
                <tr>
                <td class="c1">Id</td ><td class="c1">Name</td><td class="c1">Marks</td><td class="c1">Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($submitedStudents as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['s_id']); ?></td>
                        <td><?php echo htmlspecialchars($student['s_name']); ?></td>
                        <td><?php echo htmlspecialchars($student[$courseId]); ?></td> <!-- Display marks as plain text -->
                        <td>
                            <button class="edit-btn" onclick="toggleEdit(<?php echo $student['s_id']; ?>)">Edit</button>
                            <form action="inputMarksIntoCourse.php" method="get" id="edit-form-<?php echo $student['s_id']; ?>" style="display: none;">
                                <input type="hidden" name="year" value="<?php echo htmlspecialchars($year); ?>">
                                <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student['s_id']); ?>">
                                <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($courseId); ?>">
                                <input type="text" name="marks" class="edit-input" required>
                                <button type="submit" class="save-btn">Save</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript to toggle the edit form in the Action column -->
    <script>
        function toggleEdit(studentId) {
            const form = document.getElementById(`edit-form-${studentId}`);
            const inputField = form.querySelector('input[name="marks"]');

            if (form.style.display === "none") {
                form.style.display = "inline";
                inputField.value = ""; // Clear the input field when editing
                inputField.focus(); // Focus on input for immediate editing
            } else {
                form.style.display = "none";
            }
        }
    </script>

    <!-- Table for students who have not submitted marks -->
    <div class="head">
        <h3>The Students Whose Marks Have Not Been Entered</h3>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                <td class="c1">Id</td ><td class="c1">Name</td><td class="c1">Input Marks</td><td class="c1">Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notSubmitedStudents as $student): ?>
                    <tr>
                        <form action="inputMarksIntoCourse.php" method="get">
                            <td><?php echo htmlspecialchars($student['s_id']); ?></td>
                            <td><?php echo htmlspecialchars($student['s_name']); ?></td>
                            <td><input type="text" name="marks" required></td>
                            <td>
                                <button type="submit" class="save-btn">Save</button>
                            </td>
                            <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student['s_id']); ?>">
                            <input type="hidden" name="year" value="<?php echo htmlspecialchars($year); ?>">
                            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($courseId); ?>">
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
