<?php
session_start();
require_once "../config/course_information.php";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $id_t = $_POST['id_t'];
    $name_bank = $_POST['name_bank'];
    $account_number = $_POST['account_number'];
    try {
        $stmt = $conn->prepare("UPDATE bank SET name_bank = :name_bank, account_number = :account_number WHERE id_t = :id_t");
        $stmt->bindParam(":id_t", $id_t);
        $stmt->bindParam(":name_bank", $name_bank);
        $stmt->bindParam(":account_number", $account_number);
        $stmt->execute();
        if ($stmt->execute()) {
            $_SESSION['success'] = 'The bank information was updated successfully.';
            header("Location: bank.php");
            exit;
        } else {
            $_SESSION['error'] = 'Error updating bank information, please try again.';
            header("Location: bank.php");
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error updating bank information: ' . $e->getMessage();
        header("Location: bank.php");
        exit;
    }
}
?>
