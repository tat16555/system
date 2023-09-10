<?php
session_start();
if($_SERVER["REQUEST_METHOD"]==="POST"){
if (isset($_POST['signup'])) {

    $id = (int) $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];  

    try {
        $stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, username = :username, address = :address, phone = :phone, email = :email WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->execute()) {
            $_SESSION['success'] = 'The user information was updated successfully.';
            header("Location: user.php");
        } else {
            $_SESSION['error'] = 'Error updating user information, please try again.';
            header("Location: user.php");
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error updating user information: ' . $e->getMessage();
        header("Location: user.php");
    }
    } else {
        $_SESSION['error'] = 'Invalid user id';
        header("Location:.");
    }
}
?>
