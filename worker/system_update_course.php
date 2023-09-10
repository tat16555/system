<?php
session_start();
require_once "../config/course_information.php";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $id_Cou = $_POST['id_Cou'];
    $Cou_Name = $_POST['Cou_Name'];
    $details = $_POST['details'];
    $class_time = $_POST['class_time'];

    try {
        $stmt = $conn->prepare("UPDATE course SET Cou_Name = :Cou_Name, details = :details, class_time = :class_time WHERE id_Cou = :id_Cou");
        $stmt->bindParam(":id_Cou", $id_Cou);
        $stmt->bindParam(":Cou_Name", $Cou_Name);
        $stmt->bindParam(":details", $details);
        $stmt->bindParam(":class_time", $class_time);
        if ($stmt->execute()) {
            $_SESSION['success'] = 'The course information was updated successfully.';
            header("Location: View_course.php");
            exit;
        } else {
            $_SESSION['error'] = 'Error updating course information, please try again.';
            header("Location: View_course.php");
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error updating course information: ' . $e->getMessage();
        header("Location: View_course.php");
        exit;
    }
}
?>
