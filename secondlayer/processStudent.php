<?php

require '../db.php';

$s_name = $_POST['student_name'];
$s_id = $_POST['student_id'];
$access_token = $_POST['access_token'];
$session = $_POST['session'];
$year = $_POST['year'];


$sql ="SELECT s_name FROM student where s_id =:s_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':s_id',$s_id);
$stmt->execute();
$name = $stmt->fetch(PDO::FETCH_ASSOC);

if(empty($name['s_name'])){
   
    if((int)$year===1)
    {
        $sql = "INSERT INTO firstyear(s_id) VALUES (:s_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':s_id',$s_id);
        $stmt->execute();
    }
    else if((int)$year===2)
    {
        $sql = "INSERT INTO secondyear(s_id) VALUES (:s_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':s_id',$s_id);
        $stmt->execute();
    }
    else if((int)$year===3){
       
        $sql = "INSERT INTO thirdyear(s_id) VALUES (:s_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':s_id',$s_id);
        $stmt->execute();
    }
    else if((int)$year===4){
       
        $sql = "INSERT INTO forthyear(s_id) VALUES (:s_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':s_id',$s_id);
        $stmt->execute();
    }
    else{


    }

    $sql = "INSERT INTO student (s_id, s_name, access_token, year) VALUES (:s_id, :s_name,  :access_token, :year)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':s_id',$s_id);
    $stmt->bindParam(':s_name',$s_name);
    $stmt->bindParam(':access_token',$access_token);
    $stmt->bindParam(':year',$year);
   
   
    if( $stmt->execute()){
        header('Location: adminPage.php?success=1');
    }
}
else{
    header('Location: adminPage.php?error=1');
}

?>
