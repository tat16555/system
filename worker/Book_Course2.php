<?php 
    session_start();
    require_once '../config/db.php';
    if (!isset($_SESSION['worker_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Book Course</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!--icon-->
  <link rel="icon" type="../image/png" href="Login_v18/images/icons/favicon.ico"/>
  <link rel="stylesheet" href="../css/FormQR.css">
    <style>
            * {
            box-sizing: border-box;
            }

            /* Create two equal columns that floats next to each other */
            .column {
            float: left;
            width: 50%;
            padding: 10px;
            }

            /* Clear floats after the columns */
            .row:after {
            content: "";
            display: table;
            clear: both;
            }
            .btn:hover {
            background-color: #ddd;
            }

            .btn.active {
            background-color: #666;
            color: white;
            }
</style>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php require_once("nav1.php"); ?>
  <!-- /.navbar -->
  <?php 
      if (isset($_SESSION['worker_login'])) {
          $worker_id = $_SESSION['worker_login'];
          $stmt = $conn->query("SELECT * FROM worker WHERE id = $worker_id");
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/admin-2.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row['username'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?php require_once("nav.php"); ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Book Course</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <?php 
      require_once '../config/db.php';

      if (isset($_SESSION['worker_login'])) {
          $worker_id = $_SESSION['worker_login'];
          $stmt = $conn->prepare("SELECT * FROM worker WHERE id = :worker_id");
          $stmt->bindParam(':worker_id', $worker_id, PDO::PARAM_INT);
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
          $row = $stmt->fetch(PDO::FETCH_OBJ);
      }
      ?>
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow mb-4">
                    <div class="card-body text-center">
                        <h3 class="form-label">ชำระเงินผ่าน QR Code</h3><br>
                        <img style="max-width: 250px; margin-bottom: 10px;" src="../img/QR/PromptPay-logo.jpg" class="mx-auto d-block">
                        <a><?=$row->PromptPay_img?></a><br>
                        <h5 class="form-label">PromptPay 0622951263</h5><br>
                        <h5 class="form-label"><?=$row->price?> THB</h5><hr>
                        <h4 class="form-label"><?=$row->Cou_Name?></h4>
                        <form action="system_Book_course.php" method="post" class="register-form" id="register-form">
                            <input type="hidden" name="id_users" value="<?=$admin_id?>">
                            <div class="form-group"><br>
                                <label for="first_name_surname" class="card-title">ชื่อ-นามสกุล :</label>
                                <input type="text" class="form-control" name="first_name_surname" aria-describedby="first_name_surname" value="<?=$firstname?> <?=$lastname?>">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="card-title">เบอร์โทร </label>
                                <input type="text" class="form-control" name="phone" aria-describedby="phone" value="<?=$phone?>">
                            </div>
                            <input type="hidden" name="Cou_Name" value="<?=$row->Cou_Name?>">
                            <input type="hidden" name="price" value="<?=$row->price?>">
                            <input type="hidden" name="payment" value="KBank PromptPay">
                            <div class="form-group">
                                <label for="reference_number" class="card-title">เลขที่อ้างอิง </label>
                                <input type="text" class="form-control" name="reference_number" aria-describedby="reference_number">
                            </div>
                            <div class="form-group">
                                <label for="start_date" class="card-title">เริ่มเรียนตอน </label>
                                <input type="date" class="form-control" name="start_time" aria-describedby="start_date">
                            </div>
                            <button type="submit" class="btn btn-primary">finish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
</body>
</html>
