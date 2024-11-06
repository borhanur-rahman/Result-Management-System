<?php
session_start();
require '../db.php';

// Get teacher details from the form
$teacher_name = $_POST['teacher_name'];
$teacher_id = $_POST['teacher_id'];
$access_token = $_POST['access_token'];
$course_id = $_POST['course_id'];
$year = $_POST['year'];

$session = $_POST['session'];

$sql ="SELECT c_year FROM courses where c_id =:c_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':c_id',$course_id);
$stmt->execute();
$yearr = $stmt->fetch(PDO::FETCH_ASSOC);


$sql ="SELECT t_name FROM teacher where t_c_id =:t_c_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':t_c_id',$course_id);
$stmt->execute();
$name = $stmt->fetch(PDO::FETCH_ASSOC);


if(empty($name['t_name']) && (int)$yearr['c_year']===(int)$year){
    $_SESSION['loggedIn'] = true;
    $_SESSION['teacher_name'] = $teacher_name;
    $_SESSION['teacher_id'] = $teacher_id;
    $_SESSION['access_token'] = $access_token;
    $_SESSION['course_id'] = $course_id;
    $_SESSION['year'] = $year;
    $_SESSION['session'] = $year;



    $stmt = $pdo->prepare("UPDATE courses SET is_taken = 'yes' WHERE c_id = :c_id");
           $stmt->bindParam(':c_id', $course_id);
           $stmt->execute();

    if((int)$year===1){
        $sql = "SELECT COUNT(*) 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_SCHEMA = :database 
          AND TABLE_NAME = 'firstyear' 
          AND COLUMN_NAME = :column";

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':database' => $db,
                            ':column' => $course_id
                        ]);

                        // Fetch the result
                        $columnExists = $stmt->fetchColumn() > 0;

                        if (!$columnExists) {
                            $sql = "ALTER TABLE firstyear ADD $course_id VARCHAR(50) NULL"; 
                            $pdo->exec($sql); 
                        }
    }
    else if((int)$year===2){

        $sql = "SELECT COUNT(*) 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_SCHEMA = :database 
          AND TABLE_NAME = 'secondyear' 
          AND COLUMN_NAME = :column";

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':database' => $db,
                            ':column' => $course_id
                        ]);

                        // Fetch the result
                        $columnExists = $stmt->fetchColumn() > 0;

                        if (!$columnExists) {
                            $sql = "ALTER TABLE secondyear ADD $course_id VARCHAR(50) NULL"; 
                            $pdo->exec($sql); 
                        }

       

       
    }
    else if((int)$year===3){
        $sql = "SELECT COUNT(*) 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_SCHEMA = :database 
          AND TABLE_NAME = 'thirdyear' 
          AND COLUMN_NAME = :column";

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':database' => $db,
                            ':column' => $course_id
                        ]);

                        // Fetch the result
                        $columnExists = $stmt->fetchColumn() > 0;

                        if (!$columnExists) {
                            $sql = "ALTER TABLE thirdyear ADD $course_id VARCHAR(50) NULL"; 
                            $pdo->exec($sql); 
                        }
    }
    else if((int)$year===4){
        $sql = "SELECT COUNT(*) 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_SCHEMA = :database 
          AND TABLE_NAME = 'forthyear' 
          AND COLUMN_NAME = :column";

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':database' => $db,
                            ':column' => $course_id
                        ]);

                        // Fetch the result
                        $columnExists = $stmt->fetchColumn() > 0;

                        if (!$columnExists) {
                            $sql = "ALTER TABLE forthyear ADD $course_id VARCHAR(50) NULL"; 
                            $pdo->exec($sql); 
                        }
    }
    else
    {

    }

    $sql = "ALTER TABLE your_table_name ADD new_column VARCHAR(255) NULL";

    $sql = "INSERT INTO teacher(t_id,t_name,access_token,t_year,t_c_id) VALUES(:t_id,:t_name,:access_token,:t_year,:t_c_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':t_id',$teacher_id);
    $stmt->bindParam(':t_name',$teacher_name);

    $stmt->bindParam(':access_token',$access_token);
    $stmt->bindParam(':t_year',$year);
    $stmt->bindParam(':t_c_id',$course_id);



   

    if( $stmt->execute()){
        header('Location: adminPage.php?success=1');
    }


}
else{
    header('Location: adminPage.php?error=1');
}



?>


