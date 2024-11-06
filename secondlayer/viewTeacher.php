<?php 
require '../db.php';
 
$sql = "SELECT * FROM teacher";
$stmt = $pdo->query($sql);


$teachers= $stmt->fetchAll(PDO::FETCH_ASSOC);
    
  
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
  <h1>Teachers Lists</h1>
  </div>
  <div>
  <table>
    <tbody>
    <tr>
    <td class="c1">Id</td ><td class="c1">Name</td><td class="c1">Access Token</td><td class="c1">Year</td><td class="c1">Coruse Id</td>
    
    <?php foreach ($teachers as $teacher): ?>
      <tr>
           <td ><?php echo $teacher['t_id']; ?></td>
          <td ><?php echo $teacher['t_name']; ?></td>
          <td ><?php echo $teacher['access_token']; ?></td>  
          <td ><?php echo $teacher['t_year']; ?></td>
          <td ><?php echo $teacher['t_c_id']; ?></td>


        </tr>
 <?php endforeach; ?>

    
   

    </tbody>
  </table>
  
  </div>
 
  
 
    </ul>

 </body>
 </html>
 