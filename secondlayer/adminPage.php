<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Register Teacher or Admit Student</title>
    <link rel="stylesheet" href="../style/adminPage.css">
    <style>
        /* Hide the dropdown initially */
        #yearDropdown {
            display: none;
            margin-top: 10px;
        }
    </style>
    <script>
        function toggleForm() {
            const registerTeacherForm = document.getElementById('registerTeacherForm');
            const admitStudentForm = document.getElementById('admitStudentForm');
            const selectedOption = document.getElementById('actionSelect').value;
            
            registerTeacherForm.style.display = selectedOption === 'registerTeacher' ? 'block' : 'none';
            admitStudentForm.style.display = selectedOption === 'admitStudent' ? 'block' : 'none';
        }

        function toggleViewOptions() {
            const viewOptions = document.getElementById('viewOptions');
            const selectedOption = document.getElementById('viewSelect').value;
            
            viewOptions.style.display = selectedOption === 'viewStudents' ? 'block' : 'none';
        }

        function showYearDropdowns() {
            const yearDropdowns = document.getElementById('yearDropdowns');
            yearDropdowns.style.display = yearDropdowns.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <?php
                    if (isset($_GET['success'])) {
                        echo "<h4 style='color: green;'>Operation Successfull</h4>";
                    }
                    if (isset($_GET['error'])) {
                        echo "<h4 style='color: red;'>Some inputed item is wrong</h4>";
                    }
                ?>
            <h2>Admin Panel</h2>
            <label for="actionSelect" class="form-label">Choose Action:</label>
            <select id="actionSelect" class="form-select" onchange="toggleForm()">
                <option value="">Select an option</option>
                <option value="registerTeacher">Register Teacher</option>
                <option value="admitStudent">Admit Student</option>
            </select>

            <!-- Register Teacher Form -->
            <form id="registerTeacherForm" action="processTeacher.php" method="POST" style="display: none;">
                <h3>Register Teacher</h3>
                <input type="text" name="teacher_name" placeholder="Teacher Name" class="form-input" required>
                <input type="text" name="teacher_id" placeholder="Teacher ID" class="form-input" required>
                <input type="text" name="access_token" placeholder="Access Token" class="form-input" required>
                <input type="text" name="course_id" placeholder="Course ID" class="form-input" required>
                <input type="number" name="year" placeholder="Year" class="form-input" required>
                <input type="text" name="session" placeholder="Session" class="form-input" required>
                <button type="submit" class="form-button">Register Teacher</button>
            </form>

            <!-- Admit Student Form -->
            <form id="admitStudentForm" action="processStudent.php" method="POST" style="display: none;">
                <h3>Admit Student</h3>
                <input type="text" name="student_name" placeholder="Student Name" class="form-input" required>
                <input type="text" name="student_id" placeholder="Student ID" class="form-input" required>
                <input type="text" name="access_token" placeholder="Access Token" class="form-input" required>
                <input type="text" name="session" placeholder="Session" class="form-input" required>
                <input type="number" name="year" placeholder="Year" class="form-input" required>
                <button type="submit" class="form-button">Admit Student</button>
            </form>

            <!-- View Students and Teachers Section -->
          
        </div>

        <div class="view-section">
                <h3>View Records</h3>
                <div class ="teacher_view_button">
                <button class="form-button" onclick="window.location.href='viewTeacher.php';">View Teachers</button>
                </div>
                <div>
                <button class="form-button" type="button" onclick="toggleDropdown()">View Students</button>

                        <!-- Form with dropdown, initially hidden -->
                        <form action="studentView.php" method="POST" id="yearDropdown">
                            <select name="type" id="year" required>
                                <option value="FirstYear">First Year</option>
                                <option value="SecondYear">Second Year</option>
                                <option value="ThirdYear">Third Year</option>
                                <option value="FourthYear">Fourth Year</option>
                            </select>
                            <button class="form-button"  type="submit">View</button>
                        </form>

                        <script>
                            function toggleDropdown() {
                                // Get the dropdown element
                                const dropdown = document.getElementById("yearDropdown");

                                // Toggle visibility
                                if (dropdown.style.display === "none" || dropdown.style.display === "") {
                                    dropdown.style.display = "block"; // Show the dropdown
                                } else {
                                    dropdown.style.display = "none"; // Hide the dropdown
                                }
                            }
                        </script>
                </div>
         </div>
    </div>
</body>
</html>
