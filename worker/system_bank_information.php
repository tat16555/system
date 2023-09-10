<?php
if($_SERVER["REQUEST_METHOD"]==="POST"){
       require_once "../config/course_information.php";
       if(isset($_POST['name_bank']) && isset($_POST['account_number'])){
           $name_bank = $_POST['name_bank'];
           $account_number = $_POST['account_number'];
           $status = 'online';
           try{
               $stmt = $conn->prepare("INSERT INTO bank(name_bank,account_number,status)VALUES(:name_bank,:account_number,:status)");
               $stmt->bindParam(':name_bank', $name_bank);
               $stmt->bindParam(':account_number', $account_number);
               $stmt->bindParam(':status', $status);
               $stmt->execute();
               $_SESSION['success'] = "เพิ่มเรียบร้อย! <a href='bank.php class='alert-link'></a>";
               header("location: bank.php");
           } catch(PDOException $e) {
               echo $e->getMessage();
           }
       }
   }
   
?>
