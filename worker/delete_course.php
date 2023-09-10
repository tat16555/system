<?php
//print_r($_GET);
if(isset($_GET["id_Cou"])){
    $id_Cou = $_GET["id_Cou"];
    require_once "../config/course_information.php";
}

$result = $conn->prepare("DELETE FROM course WHERE id_Cou =  $id_Cou");
$result->execute();

header("refresh: 1; url= View_course.php");
?>