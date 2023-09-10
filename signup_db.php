<?php 

    session_start();
    require_once 'config/db.php';
    $secret = '6LcQrzIkAAAAAEMyqW8N-rsYniPUGUrlwagytcfs';
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
        $verifyResponse = file_get_contents('https://google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha);
        $responseData = json_decode($verifyResponse); 
        if(!$captcha) {
            $_SESSION['error'] = "[error 421] คุณไม่ได้ป้อน reCAPTCHA อย่างถูกต้อง!";
            header("location: signup.php");
        }
        if (isset($_POST['signup']) && $responseData->success) {
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
                header("location: signup.php");
            } else if (empty($lastname)) {
                $_SESSION['error'] = 'กรุณากรอกนามสกุล';
                header("location: signup.php");
            } else if (empty($username)) {
                $_SESSION['error'] = 'กรุณากรอกusername';
                header("location: signup.php");
            } else if (strlen($_POST['username']) > 20 || strlen($_POST['username']) < 5) {
                $_SESSION['error'] = 'usernameต้องมีความยาวอย่างน้อย 3 ตัวอักษร แต่ไม่เกิน 20 ตัวอักษร';
            } else if (empty($address)) {
                $_SESSION['error'] = 'กรุณากรอกที่อยู่';
                header("location: signup.php");
            } else if (empty($phone)) {
                $_SESSION['error'] = 'กรุณากรอกเบอร์โทรศัพท์';
                header("location: signup.php");
            } else if (strlen($_POST['phone']) > 10 || strlen($_POST['phone']) < 10) {
                $_SESSION['error'] = 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง';
                header("location: signup.php");
            } else if (empty($email)) {
                $_SESSION['error'] = 'กรุณากรอกอีเมล';
                header("location: signup.php");
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
                header("location: signup.php");
            } else if (empty($password)) {
                $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
                header("location: signup.php");
            } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
                $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
                header("location: signup.php");
            } else if (empty($c_password)) {
                $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
                header("location: signup.php");
            } else if ($password != $c_password) {
                $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
                header("location: signup.php");
            } else {
                try {
    
                    $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                    $check_email->bindParam(":email", $email);
                    $check_email->execute();
                    $row = $check_email->fetch(PDO::FETCH_ASSOC);
    
                    if ($row['email'] == $email) {
                        $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                        header("location: signup.php");
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
                        $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! <a href='signin.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                        header("location: signup.php");
                    } else {
                        $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                        header("location: signup.php");
                    }
    
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
    }
?>