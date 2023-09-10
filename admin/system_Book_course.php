<?php
if($_SERVER["REQUEST_METHOD"]==="POST"){
    require_once "../config/course_information.php";
    $user_id = $_POST['id_users'];
    $first_name_surname = $_POST['first_name_surname'];
    $phone = $_POST['phone'];
    $Cou_Name = $_POST['Cou_Name'];
    $price = $_POST['price'];
    $payment = $_POST['payment'];
    $reference_number = $_POST['reference_number'];
    $status = 'not verified';
    $start_time = $_POST['start_time'];
    extract($_POST);

    try {
        $stmt = $conn->prepare("INSERT INTO reserve(id_users, first_name_surname, phone, Cou_Name, price, payment, reference_number, status, start_time) VALUES(:id_users, :first_name_surname, :phone, :Cou_Name, :price, :payment, :reference_number, :status, :start_time)");
        $stmt->bindParam(':id_users', $id_users);
        $stmt->bindParam(':first_name_surname', $first_name_surname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':Cou_Name', $Cou_Name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':payment', $payment);
        $stmt->bindParam(':reference_number', $reference_number);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':start_time', $start_time);
        $stmt->execute();
        header("refresh: 1; url= Book_Course.php");
    } catch(PDOException $e) {
        header("refresh: 1; url= Book_Course.php");
    }
}
$conn = null;
