<?php
if($_SERVER["REQUEST_METHOD"]==="POST"){
       require_once "../config/course_information.php";
       // echo '<pre>', print_r($_POST), '</pre>';
       if($_SERVER["REQUEST_METHOD"]==="POST"){
              $id_Type = $_POST['id_Type'];
              $Type_Name = $_POST['Type_Name'];
              $Cou_Name = $_POST['Cou_Name'];
              $details = $_POST['details'];
              $price = $_POST['price'];
              $class_time = $_POST['class_time'];
                     try{
                            $stmt = $conn->prepare("INSERT INTO course(id_Type,Type_Name,Cou_Name,details,price,class_time)VALUES(:id_Type,:Type_Name,:Cou_Name,:details,:price,:class_time)");
                            $stmt->bindParam(':id_Type', $id_Type);
                            $stmt->bindParam(':Type_Name', $Type_Name);
                            $stmt->bindParam(':Cou_Name', $Cou_Name);
                            $stmt->bindParam(':details', $details);
                            $stmt->bindParam(':price', $price);
                            $stmt->bindParam(':class_time', $class_time);
                            $stmt->execute();
                            $_SESSION['success'] = "เพิ่มเรียบร้อย! <a href='View_course.php class='alert-link'></a>";
                            header("location: View_course.php");
                     } catch(PDOException $e) {
                            echo $e->getMessage();
                     }
              }
       }
       $conn = null;
?>
