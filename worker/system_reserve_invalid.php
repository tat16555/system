<?php
    session_start();
    require_once "../config/course_information.php";
    
    if (isset($_GET['ID_Re'])) {
        $ID_Re = $_GET['ID_Re'];
        $status = 'failed';

        try {
            $stmt = $conn->prepare("UPDATE reserve SET status = :status WHERE ID_Re = :ID_Re");
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":ID_Re", $ID_Re);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['success'] = 'The transaction information was updated successfully.';
            } else {
                $_SESSION['error'] = 'Error updating transaction information, please try again.';
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Error updating transaction information: ' . $e->getMessage();
        }
        header("Location: reserve.php");
        exit();
    } else {
        $_SESSION['error'] = 'Invalid transaction id';
        header("Location: reserve.php");
        exit();
    }
?>
