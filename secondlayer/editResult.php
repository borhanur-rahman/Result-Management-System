<?php 
require '../db.php';
$year = $_POST['year'];
$course_id = $_POST['course_id'];
$studen_id = $_POST['course_id'];
$mark = $_POST['marks'];
$status="";

if((int)$mark<=100 && (int)$mark>=0) {



    if((int)$year ===2){
        $stmt = $pdo->prepare("UPDATE secondyear SET $course_id = :marks WHERE s_id = :id");
        $stmt->bindParam(':marks', $mark);
        $stmt->bindParam(':id', $studen_id);


        if($stmt->execute()){
            $status="success";
        }
    
    }
   


}
else{
    $status="error";
}







?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="inputMarksIntoCourse.php" method="post">
    <input type="hidden" name="course_year" value=<?php echo $year;  ?>>
    <input type="hidden" name="course_id" value=<?php echo $course_id;  ?>>
    <button type="submit">submit</button>


    </form>
</body>
</html>