<?php 
require '../db.php';
session_start();
$userid = $_SESSION['userid'] ?? '';

$sql ="SELECT * FROM student where s_id =:s_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':s_id',$userid);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);
if((int)$student['year']===3){

    
    $sql ="SELECT * FROM courses where c_year =:c_year AND is_taken ='yes'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':c_year',$student['year']);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $sql ="SELECT * FROM thirdyear where s_id =:s_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':s_id',$userid);
    $stmt->execute();
    $result= $stmt->fetch(PDO::FETCH_ASSOC);


}
else if((int)$student['year']===1){

    
    $sql ="SELECT * FROM courses where c_year =:c_year AND is_taken ='yes'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':c_year',$student['year']);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $sql ="SELECT * FROM firstyear where s_id =:s_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':s_id',$userid);
    $stmt->execute();
    $result= $stmt->fetch(PDO::FETCH_ASSOC);


}
else if((int)$student['year']===2){

    
    $sql ="SELECT * FROM courses where c_year =:c_year AND is_taken ='yes'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':c_year',$student['year']);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $sql ="SELECT * FROM secondyear where s_id =:s_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':s_id',$userid);
    $stmt->execute();
    $result= $stmt->fetch(PDO::FETCH_ASSOC);


}
else if((int)$student['year']===4){

    
    $sql ="SELECT * FROM courses where c_year =:c_year AND is_taken ='yes'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':c_year',$student['year']);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $sql ="SELECT * FROM forthyear where s_id =:s_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':s_id',$userid);
    $stmt->execute();
    $result= $stmt->fetch(PDO::FETCH_ASSOC);


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Card</title>
    <link rel="stylesheet" href="../style/studentPage.css">
</head>
<body>

<div class="card-container">
    <div class="student-card">
        <h2>Student Information</h2>
        <p><strong>ID:</strong><?php echo $student['s_id'] ?></p>
        <p><strong>Name:</strong><?php echo $student['s_name'] ?></p>
        <table>
            <tbody>
            <tr>
                <td><h3>Courses</h3></td>  <td><h3>Marks</h3></td> 
                </tr>
                <?php foreach ($courses as $course): ?>
                 <tr>
                <td ><?php echo $course['c_id']; ?> </td>    <td>  <?php echo $result[$course['c_id']]; ?> </td>
        


        </tr>
 <?php endforeach; ?>

            </tbody>
        </table>
        
    </div>
</div>

</body>
</html>
