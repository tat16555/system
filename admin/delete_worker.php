<?php
//print_r($_GET);
if(isset($_GET["id"])){
    $id = $_GET["id"];
    require_once "../config/db.php";
}

$result = $conn->prepare("DELETE FROM worker WHERE id =  $id ");
$result->execute();

header("refresh: 1; url= worker.php");
?>