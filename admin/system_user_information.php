<?php 

    session_start();
    require_once '../config/db.php';

    if (isset($_POST['post'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $urole = 'user';
        
        
        if (empty($firstname)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: user_information.php");
        } else if (empty($lastname)) {
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header("location: user_information.php");
        } else if (empty($username)) {
            $_SESSION['error'] = 'กรุณากรอกusername';
            header("location: user_information.php");
        } else if (strlen($_POST['username']) > 20 || strlen($_POST['username']) < 5) {
            $_SESSION['error'] = 'usernameต้องมีความยาวอย่างน้อย 3 ตัวอักษร แต่ไม่เกิน 20 ตัวอักษร';
        } else if (empty($address)) {
            $_SESSION['error'] = 'กรุณากรอกที่อยู่';
            header("location: user_information.php");
        } else if (empty($phone)) {
            $_SESSION['error'] = 'กรุณากรอกเบอร์โทรศัพท์';
            header("location: user_information.php");
        } else if (strlen($_POST['phone']) > 10 || strlen($_POST['phone']) < 10) {
            $_SESSION['error'] = 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง';
            header("location: user_information.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: user_information.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: user_information.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: user_information.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: user_information.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: user_information.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: user_information.php");
        } else {
            try {

                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) {
                    $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: user_information.php");
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, username, address, phone, email, password, urole) 
                                            VALUES(:firstname, :lastname, :username, :address, :phone, :email, :password, :urole)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":address", $address);
                    $stmt->bindParam(":phone", $phone);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->execute();
                    $_SESSION['success'] = "เพิ่มสมัครสมาชิกเรียบร้อย! <a href='user_information.php' class='alert-link'></a>";
                    header("location: user_information.php");
                } else {
                    $_SESSION['error'] = "เกิดข้อผิดพลาด!";
                    header("location: user_information.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>