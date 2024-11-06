<?php
session_start();
require 'db.php';

// Retrieve form data

$userid = $_POST['userid'];
$password = $_POST['password'];
$userType = $_POST['userType'];
$user;

if($userType==='admin'){
   $sql="SELECT * FROM admins WHERE admin_id =:admin_id";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':admin_id',$userid);
   $stmt->execute();
   $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
if($userType==='student'){
    $sql="SELECT access_token FROM student WHERE s_id =:s_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':s_id',$userid);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC); 
}
if($userType==='teacher'){
    $sql="SELECT access_token FROM teacher WHERE t_id =:t_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':t_id',$userid);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC); 
}



// Verify password and user type
if ($password === $user['access_token']) {
    // Set session to track the login state
    $_SESSION['loggedIn'] = true;
   
    $_SESSION['userType'] = $userType;
    $_SESSION['userid'] = $userid;

    // Redirect based on userType
    if ($userType === 'student') {
        header('Location: secondlayer/studentPage.php');
    } elseif ($userType === 'teacher') {
        header('Location: secondlayer/teacherPage.php');
    } elseif ($userType === 'admin') {
        header('Location: secondlayer/adminPage.php');
    }
    exit();
} else {
    // Redirect back to home with error message
    header('Location: index.php?error=1');
    exit();
}


?>



