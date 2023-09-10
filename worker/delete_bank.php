<?php
//print_r($_GET);
if(isset($_GET["id_t"])){
    $id_t = $_GET["id_t"];
    require_once "../config/course_information.php";
}

$result = $conn->prepare("DELETE FROM bank WHERE id_t =  $id_t");
$result->execute();

header("refresh: 1; url= bank.php");
?>