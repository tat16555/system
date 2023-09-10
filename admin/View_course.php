<?php 

    session_start();
    require_once '../config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: ../signin.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>course</title>

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

  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../admin.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li>
        <a href="../logout.php" class="btn btn-danger" class="nav-link" data-widget="fullscreen" >Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
          <?php 
      if (isset($_SESSION['admin_login'])) {
          $admin_id = $_SESSION['admin_login'];
          $stmt = $conn->query("SELECT * FROM admin WHERE id = $admin_id");
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ข้อมูลคอร์สเรียน</h1>
            <div class="mt-3">
                <a href="course_information.php"><button type="button" class="btn btn-primary">เพิ่มข้อมูลคอร์สเรียน</button></a>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <table class="table">
          <thead class="table-success">
              <tr>
                <th colspan="7">
                <form action="" method="post">
                      <input class="form-control me-2" type="text" name="search" placeholder="Search">     
                </th>
                <th>
                      <input class="btn btn-outline-success" type="submit" value="Search">
                </th>
                <th>
                      <input class="btn btn-danger" type="reset" value="Reset">
                </th>
                <?php
                  if (isset($_POST['search'])) {
                    $search = $_POST['search'];
                  }
                ?>
                </form> 
              </tr>
          </thead>
          <thead class="table-primary">
              <tr>    
              <th scope="col">#</th>
                    <th scope="col">ประเภท</th>
                    <th scope="col">ชื่อคอร์ส</th>
                    <th scope="col">รายละเอียด</th>
                    <th scope="col">ราคา</th>
                    <th scope="col">time</th>
                    <th scope="col">เพิ่มเมื่อ</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
              </tr>
          </thead>
          <tbody class="table-info">
              <?php 
                  require_once '../config/course_information.php';
                  if (isset($_POST['search'])) {
                      $search = $_POST['search'];
                      $stmt = $conn->query("SELECT * FROM course WHERE Cou_Name LIKE '%$search%' OR details LIKE '%$search%' OR price LIKE '%$search%'");
                  } else {
                      $stmt = $conn->query("SELECT * FROM course");
                  }

                  $stmt->execute();
                  $course = $stmt->fetchAll();
                  $months = array();
                  if (!$course) {
                      echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                  } else {
                      foreach($course as $easy)  {  
              ?>
              
                  <tr id="myMenu">
                        <th scope="row"><?php echo $easy['id_Cou']; ?></th>
                        <td><?php echo $easy['id_Type']; ?></td>
                        <td><?php echo $easy['Cou_Name']; ?></td>
                        <td><?php echo $easy['details']; ?></td>
                        <td><?php echo $easy['price']; ?>THB</td>
                        <td><?php echo $easy['class_time']; ?></td>
                        <td><?php echo $easy['created_at']; ?></td>              
                        <td><a href="update_course.php?id_Cou=<?=$easy['id_Cou']; ?>" class="btn btn-warning">Edit</a>  </td>
                        <td><a href="delete_course.php?id_Cou=<?=$easy['id_Cou']; ?>" class="btn btn-danger">Delete</a></td>
                  </tr>
              <?php }  } ?>
          </tbody>
      </table>
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
