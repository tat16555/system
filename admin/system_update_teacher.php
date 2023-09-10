<?php
session_start();
require_once "../config/course_information.php";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $id_Teach = $_POST['id_Teach'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];	
    try {
        $stmt = $conn->prepare("UPDATE teacher SET firstname = :firstname, lastname = :lastname, address = :address, phone = :phone, email = :email WHERE id_Teach = :id_Teach");
        $stmt->bindParam(":id_Teach", $id_Teach);
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if ($stmt->execute()) {
            $_SESSION['success'] = 'The teacher information was updated successfully.';
            header("Location: View_teacher.php");
            exit;
        } else {
            $_SESSION['error'] = 'Error updating teacher information, please try again.';
            header("Location: View_teacher.php");
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error updating teacher information: ' . $e->getMessage();
        header("Location: View_teacher.php");
        exit;
    }
}
?>
