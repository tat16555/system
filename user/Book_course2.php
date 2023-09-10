<?php 
    session_start();
    require_once '../config/db.php';
    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: ../signin.php');
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<?php 
    require_once '../config/db.php';
    if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $phone = $row['phone'];
    }
    require_once '../config/course_information.php';
    if(isset($_GET['id_Cou'])) {
        $stmt = $conn->prepare("SELECT * FROM course WHERE id_Cou = :id_Cou");
        $stmt->bindParam(':id_Cou', $_GET['id_Cou'], PDO::PARAM_INT);
        $stmt->execute();
        
        if($stmt->rowCount()){
            $row = $stmt->fetch(PDO::FETCH_OBJ);
        }
    }
?>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow mb-4">
                    <div class="card-body text-center">
                        <h3 class="card-title">ชำระเงินผ่าน QR Code</h3>
                        <img style="max-width: 250px; margin-bottom: 10px;" src="../img/QR/PromptPay-logo.jpg" class="mx-auto d-block">
                        <a><?=$row->PromptPay_img?></a>
                        <h5 class="card-title">0622951263</h5>
                        <h5 class="card-title"><?=$row->price?> THB</h5>
                        <h4 class="card-title"><?=$row->Cou_Name?></h4>
                        <form action="system_Book_course.php" method="post" class="register-form" id="register-form">
                            <input type="hidden" name="id_users" value="<?=$user_id?>">
                            <div class="form-group">
                                <label for="first_name_surname" class="form-label">ชื่อ-นามสกุล :</label>
                                <input type="text" class="form-control" name="first_name_surname" aria-describedby="first_name_surname" value="<?=$firstname?> <?=$lastname?>">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">เบอร์โทร :</label>
                                <input type="text" class="form-control" name="phone" aria-describedby="phone" value="<?=$phone?>">
                            </div>
                            <input type="hidden" name="Cou_Name" value="<?=$row->Cou_Name?>">
                            <input type="hidden" name="price" value="<?=$row->price?>">
                            <input type="hidden" name="payment" value="KBank PromptPay">
                            <div class="form-group">
                                <label for="reference_number" class="form-label">เลขที่อ้างอิง :</label>
                                <input type="text" class="form-control" name="reference_number" aria-describedby="reference_number">
                            </div>
                            <div class="form-group">
                                <label for="start_date" class="form-label">เริ่มเรียนตอน :</label>
                                <input type="date" class="form-control" name="start_time" aria-describedby="start_date">
                            </div>
                            <button type="submit" class="btn btn-primary">finish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>