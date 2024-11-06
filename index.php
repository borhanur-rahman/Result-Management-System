<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sign In</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Sign In</h2>
            <form action="authenticateUser.php" method="POST">
                <div class="input-box">
                    <input type="text" id="userid" name="userid" required>
                    <label>User ID</label>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="input-box">
                    <label for="userType">Sign In as:</label>
                    <select id="userType" name="userType" required>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn">Sign In</button>
                <?php
                    if (isset($_GET['error'])) {
                        echo "<p style='color: red;'>Invalid username or password.</p>";
                    }
                ?>
            </form>
        </div>
    </div>
</body>
</html>
