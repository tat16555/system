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
  <title>worker information</title>

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
  </nav>
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
            <h1 class="m-0">เพิ่มข้อมูลพนักงาน</h1><a href="worker.php"><button type="button" class="btn btn-warning">ดูข้อมูลพนักงานทั้งหมด</button></a>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
        <form action="system_worker_information.php" method="post" class="register-form" id="register-form">
                        <?php if(isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php 
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                ?>
                            </div>
                                <?php } ?>
                                <?php if(isset($_SESSION['success'])) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php 
                                            echo $_SESSION['success'];
                                            unset($_SESSION['success']);
                                        ?>
                                    </div>
                                <?php } ?>
                                    <?php if(isset($_SESSION['warning'])) { ?>
                                        <div class="alert alert-warning" role="alert">
                                            <?php 
                                                echo $_SESSION['warning'];
                                                unset($_SESSION['warning']);
                                            ?>
                                        </div>
                        <?php } ?><hr>
                    <h3>กรอกแบบฟอร์ม</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstname" class="form-label">First name :</label>
                                <input type="text" class="form-control" name="firstname" id="name" aria-describedby="firstname">
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="form-label">Last name :</label>
                                <input type="text" class="form-control" name="lastname" id="father_name" aria-describedby="lastname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-label">username :</label>
                            <input type="text" class="form-control" name="username" id="name" aria-describedby="username">
                        </div>
                        <div class="form-group">
                            <label for="address">Address :</label>
                            <input type="text" class="form-control" name="address" id="address" required/>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone :</label>
                            <input type="phone" class="form-control" name="phone" id="phone" aria-describedby="phone">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email ID :</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password :</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="confirm password" class="form-label">Confirm Password :</label>
                            <input type="password" class="form-control" name="c_password" id="c_password">
                        </div>

                        <div>
                            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
                            <a href="admin.php"><button type="button" class="btn btn-warning">ดูข้อมูลadminทั้งหมด</button></a>
                            <hr>
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