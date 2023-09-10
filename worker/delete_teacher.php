<?php
//print_r($_GET);
if(isset($_GET["id_Teach"])){
    $id_Teach = $_GET["id_Teach"];
    require_once "../config/course_information.php";
}

$result = $conn->prepare("DELETE FROM course WHERE id_Teach =  $id_Teach");
$result->execute();

header("refresh: 1; url= View_teacher.php");
?>