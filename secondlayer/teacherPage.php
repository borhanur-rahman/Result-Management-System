<?php 
require '../db.php';
session_start();
$userid = $_SESSION['userid'] ?? '';

$sql ="SELECT * FROM teacher where t_id =:t_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':t_id',$userid);
$stmt->execute();
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="../style/teacherPage.css">
</head>
<body>
    <h1 class="page-title">Courses</h1>
    <div class="cards">

    <?php foreach ($teachers as $teacher): ?>

      <div class="container">
        <!-- Example Card Structure -->
        <form action="inputMarksIntoCourse.php" method="POST" class="card">
            <div class="card-header">
                <input type="hidden" name="course_id" value="<?php echo $teacher['t_c_id']; ?>">
                <input type="hidden" name="course_year" value="<?php echo $teacher['t_year']; ?>">
                <h2><?php  echo $teacher['t_c_id']; ?></h2>
                <?php
                    $sql ="SELECT * FROM courses where c_id =:c_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':c_id',$teacher['t_c_id']);
                    $stmt->execute();
                    $courseName = $stmt->fetch(PDO::FETCH_ASSOC); 
                    
                    ?>
            </div>
            <div class="card-body">
                <p><?php  echo  $courseName['c_name']; ?></p>
            </div>
            <div class="card-footer">
                <button type="submit" name="view_course" class="view-btn">View</button>
            </div>
        </form>
    </div>
      
      <?php endforeach; ?>
   
    </div>
   
</body>
</html>
