<?php
if($_SERVER["REQUEST_METHOD"]==="POST"){
       require_once "../config/course_information.php";
       // echo '<pre>', print_r($_POST), '</pre>';
       extract($_POST);
                     try{
                            $stmt = $conn->prepare("INSERT INTO teacher(firstname,lastname,address,phone,email,gender)VALUES(:firstname,:lastname,:address,:phone,:email,:gender)");
                            $stmt->bindParam(':firstname', $firstname);
                            $stmt->bindParam(':lastname', $lastname);
                            $stmt->bindParam(':address', $address);
                            $stmt->bindParam(':phone', $phone);
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':gender', $gender);
                            $stmt->execute();
                            header("refresh: 1; url=View_teacher.php");
                     } catch(PDOException $e){
                            // กลับไปกรอกข้อมูลใหม่
                            header("refresh: 1; url=View_teacher.php");
                     } $conn = null;
              }

