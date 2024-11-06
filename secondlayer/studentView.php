<?php
require '../db.php';
$type = $_POST['type'];
$sql=[];
switch ($type) {
    case "FirstYear":
        $sql = "SELECT * FROM student WHERE year=1";
        $stmt = $pdo->prepare($sql);
       
        break;
    case "SecondYear":
        $sql = "SELECT * FROM student WHERE year=2";
        $stmt = $pdo->prepare($sql);
        break;
    case "ThirdYear":
        $sql = "SELECT * FROM student WHERE year=3";
        $stmt = $pdo->prepare($sql);
        break;
    case "FourthYear":
        $sql = "SELECT * FROM student WHERE year=4";
        $stmt = $pdo->prepare($sql);
        break;
  
}


$stmt->execute();
$students= $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books</title>
 
 <link rel="stylesheet" href="../style/teacherView.css">
 <body>
 <ul>
  <div class="head">
  <h1>Students Lists</h1>
  </div>
  <div>
  <table>
    <tbody>
    <tr>
    <td class="c1">Id</td ><td class="c1">Name</td><td class="c1">Access Token</td><td class="c1">Year</td>
    
    <?php foreach ($students as $student): ?>
      <tr>
           <td ><?php echo $student['s_id']; ?></td>
          <td ><?php echo $student['s_name']; ?></td>
          <td ><?php echo $student['access_token']; ?></td>  
          <td ><?php echo $student['year']; ?></td>
          

        </tr>
 <?php endforeach; ?>

    
   

    </tbody>
  </table>
  
  </div>
 
  
 
    </ul>

 </body>
 </html>
