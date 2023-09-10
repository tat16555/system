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
  <title>bank</title>

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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ข้อมูลคอร์สเรียน</h1>
            <div class="mt-3">
                <a href="bank_information.php"><button type="button" class="btn btn-primary">เพิ่มข้อมูล</button></a>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <table class="table">
          <thead class="table-success">
              <tr>
                <th colspan="5">
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
                    <th scope="col">ธนาคาร</th>
                    <th scope="col">เลขที่บัญชี</th>
                    <th scope="col">status</th>
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
                      $stmt = $conn->query("SELECT * FROM bank WHERE id_t LIKE '%$search%' OR name_bank LIKE '%$search%' OR account_number LIKE '%$search%'");
                  } else {
                      $stmt = $conn->query("SELECT * FROM bank");
                  }

                  $stmt->execute();
                  $bank = $stmt->fetchAll();
                  $months = array();
                  if (!$bank) {
                      echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                  } else {
                      foreach($bank as $easy)  {  
              ?>
              
                  <tr id="myMenu">
                        <th scope="row"><?php echo $easy['id_t']; ?></th>
                        <td><?php echo $easy['name_bank']; ?></td>
                        <td><?php echo $easy['account_number']; ?></td>
                        <td><?php echo $easy['status']; ?></td>
                        <td><?php echo $easy['created_at']; ?></td>          
                        <td><a href="update_bank.php?id_t=<?=$easy['id_t']; ?>" class="btn btn-warning">Edit</a></td>
                        <td><a href="delete_bank.php?id_t=<?=$easy['id_t']; ?>" class="btn btn-danger">Delete</a></td>
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
