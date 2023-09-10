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
  <title>Bank information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php 
      if (isset($_SESSION['worker_login'])) {
          $worker_id = $_SESSION['worker_login'];
          $stmt = $conn->query("SELECT * FROM worker WHERE id = $worker_id");
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    ?>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">เพิ่มข้อมูลคอร์สเรียน</h1><a href="View_course.php"><button type="button" class="btn btn-warning">ดูข้อมูลคอร์สเรียนทั้งหมด</button></a>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
        <form action="system_course_information.php" method="post">
                  <div class="col-md-4">
                    <select name="id_Type" id="inputState" class="form-select">
                      <option selected>เลือก...</option>
                      <option  name="id_Type" value="01">Type01</option>
                      <option  name="id_Type" value="02">Type02</option>
                      <option  name="id_Type" value="03">Type03</option>
                      <option  name="id_Type" value="04">Type04</option>
                    </select>
                    <select name="Type_Name" id="inputState" class="form-select">
                      <option selected>เลือก...</option>
                      <option  name="Type_Name" value="Intermediate Class Training">ยังไม่มีพื้นฐาน ( Basic/Beginner Class training )</option>
                      <option  name="Type_Name" value="Intermediate Class Training">มีพื้นฐานแล้ว ( Intermediate Class Training )ง ( Advance Class Training )</option>
                      <option  name="Type_Name" value="Advance Class Training">ฝึกทักษะป้องกันตัวแบบจริงจัง ( Advance Class Training )</option>
                      <option  name="Type_Name" value="Private Training">เรียนตัวต่อตัว ( Private Training )</option>
                    </select>
                  </div>
                  </div>
                  <div class="mb-3">
                      <label for="Cou_Name" class="form-label">ชื่อคอร์สเรียน : </label>
                      <input type="text" class="form-control" id="Cou_Name" name="Cou_Name">
                  </div>
                  <div class="mb-3">
                      <label for="details" class="form-label">รายละเอียดเพิ่มเติม : </label>
                      <input type="text" class="form-control" id="details" name="details">
                  </div>
                  <div class="mb-3">
                      <label for="price" class="form-label">ราคา : </label>
                      <input type="text" class="form-control" id="price" name="price">
                  </div>
                  <div class="mb-3">
                      <label for="class_time" class="form-label">เวลาเรียน : </label>
                      <input type="text" class="form-control" id="class_time" name="class_time">
                  </div>
                  <div class="mt-3">
                      <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                      <a href="View_course.php"><button type="button" class="btn btn-warning">ดูข้อมูลคอร์สเรียนทั้งหมด</button></a>
                  </div>
              </form>
      </div><!-- /.container-fluid -->
    </div>
    </div>
    <!-- /.content-header -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
