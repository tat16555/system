<?php 
    session_start(); 
    include_once '../config/dbConfig.php';
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
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/signin.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php  if (!empty($_SESSION['statusMsg'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php 
                            echo $_SESSION['statusMsg']; 
                            unset($_SESSION['statusMsg']);
                ?>
            </div>
        <?php } ?>
    </head>
<body>
<?php
if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $file = fopen("appeal.txt", "a");
        fwrite($file, $name . "-" . $comment . "\n");
        fclose($file);
    }
?>
<?php
require_once '../config/db.php';

if (isset($_SESSION['user_login'])) {
    $id_users = $_SESSION['user_login'];

    // Retrieve user information from the users table
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id_users");
    $stmt->bindParam(':id_users', $id_users, PDO::PARAM_INT);
    $stmt->execute();
    $user_row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
        <div class="topnav">
            <a href="../user.php">Home</a>
            <a href="news.php">News</a>
            <a href="../user/Book_course.php">Book a course</a>
            <div class="topnav-right">
                <a class="active" href="profile.php"><?php echo $user_row['username'] ?></a>
                <a style="color:red" href="../logout.php">Logout</a><br>
            </div>
        </div>
        <div class="floating-icon"></div>
        <div id="message-box" style="display:none; position:fixed; bottom:80px; right:20px; background-color:#fff; padding:20px; border:1px solid #ccc;">
        <h3>รายงานปัญหาให้ผู้ดูแลระบบทราบ</h3>
            <form action="" method="post">
                <input type="text" name="name" placeholder="Your Name"><br>
                <input type="text" class="form-control" name="comment" placeholder="บอกปัญหาของคุณให้ฉันทราบ"></textarea>
                <input class="" type="submit" name="submit"><hr>
            </form> 
    </div>
    <body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="user_icon.png" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            <h2><?php echo $user_row['username'] ?></h2>
          </div>
        </div>
        <div class="w3-container">
          <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>...</p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $user_row['address'] ?></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $user_row['email'] ?></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $user_row['phone'] ?></p>
          <hr>

          <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>ชื่อ-นามสกุล</b></p>
          <p><?php echo $user_row['firstname'] ?> <?php echo $user_row['lastname'] ?></p>
          <hr>
          <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Setting</b></p>
          <a class="btn btn-primary">แก้ไขข้อมูล</a>
          <!-- <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
          ดูประวัติ รายการชำระเงิน
        </button> -->
      <button type="button" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#exampleModal" id="openModal">ประวัติ การจองคอร์ส</button>
<style>
  .modal-lg .modal-dialog {
    max-width: 1000%;
  }
</style>
        </div><br><hr>
      </div><br>
    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Profile : <?php echo $user_row ['username'] ?></h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>ระดับโรงยิม</b></h5>
          <p>ระดับเริ่มต้น ระดับกลาง ระดับสูง นักสู้</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>การฝึกมวยไทยแบบดั้งเดิมและดั้งเดิม</b></h5>
            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>ตารางเรียน</h6>
            <img src="../img/C_T.jpg" style="width:100%" alt="Avatar" style="width:100%" alt="Avatar"><hr>
        </div>
      </div>

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

<footer class="w3-container w3-teal w3-center w3-margin-top">
<h6>Profile</h6>
</footer>
<?php require_once("modal.php"); ?>
</body>
<script>
    var modal = document.querySelector('.modal');
    var openModalBtn = document.querySelector('#openModal');
    var closeModalBtn = document.querySelector('#close');

    // Open the modal when the button is clicked
    openModalBtn.addEventListener('click', function() {
    modal.style.display = 'block';
    });

    // Close the modal when the close button is clicked
    closeModalBtn.addEventListener('click', function() {
    modal.style.display = 'none';
    });

    var closeModalBtn = document.querySelector('#close');
    var modal = document.querySelector('.modal');

    closeModalBtn.addEventListener('click', function() {
      modal.style.display = 'none';
    });
</script>
</body>
</html>