<?php 
    session_start();
    require_once 'config/db.php';
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
  <title>Worker</title>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartkick"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!--icon-->
  <link rel="icon" type="image/png" href="Login_v18/images/icons/favicon.ico"/>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <style>
      .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
      }

      .active, .accordion:hover {
        background-color: #ccc; 
      }

      .panel {
        padding: 0 18px;
        display: none;
        background-color: white;
        overflow: hidden;
      }
    </style> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="worker.php" class="nav-link">Home</a>
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
        <a href="logout.php" class="btn btn-danger" class="nav-link" data-widget="fullscreen" >Logout</a>
      </li>
    </ul>
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
          <img src="dist/img/admin-2.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row['username'] ?></a>
        </div>
      </div>
      <?php 
          $stmt = $conn->query("SELECT COUNT(*) as total_users FROM users");
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $total_users = $row['total_users'];

          $stmt = $conn->query("SELECT DATE_FORMAT(created_at, '%Y-%m') AS date, COUNT(*) as signups FROM users GROUP BY DATE_FORMAT(created_at, '%Y-%m')");
          $data = [];
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = [$row['date'], intval($row['signups'])];
          }
      ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="worker/reserve.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reserve</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                  Control user
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="worker/user.php" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>user</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="worker/worker.php" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>worker</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Content
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="worker/control.php" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>news post</p>
                </a>
              </li>
              <li class="nav-item">
              <li class="nav-item">
                <a href="worker/course_information.php" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>เพิ่มข้อมูลคอร์สเรียน</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="worker/teacher_information.php" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>เพิ่มข้อมูลครู</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="worker/bank.php" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>เพิ่มข้อมูลbank</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>เพิ่มข้อมูล???</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon far fa-plus-square"></i>
                  <p>เพิ่มข้อมูล???</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="worker/calendar.php" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="worker/View_gallery.php" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="worker/Book_Course.php" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Book Course</p>
            </a>
          </li>
      </nav>
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
      <?php 
          require_once "config/course_information.php";
          // count total rows
          $stmt = $conn->query("SELECT COUNT(*) as total_rows FROM reserve");
          $stmt->execute();
          $result = $stmt->fetch();
          $total_rows = $result['total_rows'];

          // count completed rows
          $stmt = $conn->query("SELECT COUNT(*) as complished_rows FROM reserve WHERE status = 'complished'");
          $stmt->execute();
          $result = $stmt->fetch();
          $complished_rows = $result['complished_rows'];

          // count failed rows
          $stmt = $conn->query("SELECT COUNT(*) as failed_rows FROM reserve WHERE status = 'failed'");
          $stmt->execute();
          $result = $stmt->fetch();
          $failed_rows = $result['failed_rows'];

          $verified = $failed_rows + $complished_rows;
          // count not verified rows
          $stmt = $conn->query("SELECT COUNT(*) as not_verified_rows FROM reserve WHERE status = 'not verified'");
          $stmt->execute();
          $result = $stmt->fetch();
          $not_verified_rows = $result['not_verified_rows'];
          // calculate percentages
          $complished_percentage = ($complished_rows / $verified) * 100;
          $complished_percentage_formatted = number_format($complished_percentage, 1);  
          $failed_percentage = ($failed_rows / $verified) * 100;
          $failed_percentage_formatted = number_format($failed_percentage, 1);
      
          $verified2 = ($verified / $total_rows) * 100;
          $verified2_percentage_formatted = number_format($verified2, 1); 
          $not_verified2 = ($not_verified_rows / $total_rows) * 100;
          $not_verified2_percentage_formatted = number_format($not_verified2, 1);
      ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $total_rows; ?></h3>

                <p>Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $complished_percentage_formatted; ?><sup style="font-size: 20px">%</sup></h3>

                <p>successful transaction</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $total_users; ?></h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="admin/user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <?php
                $file = fopen("Home_count.txt", "r");
                  while (!feof($file)) {
                  $line = fgets($file);
                  $line = explode("-", $line);
                  if (count($line) >= 1) {
                  echo "<h3>". $line[0] . "</h3>";
                  }
                }
                fclose($file);
             ?>
                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <?php require_once("worker/chrat/U_chrat.php"); ?>
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Successful transaction rate graph
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <?php require_once("worker/chrat/chrat1.php"); ?>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Transaction verification rate graph
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <?php require_once("worker/chrat/chrat2.php"); ?>
                </div>
                </div>
            </div>
          </div>
        <button class="accordion">รีวิวเว็บไซต์</button>
          <div class="panel">
          <?php
              $file = fopen("commentHome.txt", "r");
                while (!feof($file)) {
                $line = fgets($file);
                $line = explode("-", $line);
                if (count($line) >= 3) {
                    echo "<h3><b><a style='color: rgb(27, 27, 147);'>" . $line[0] . "</a></b>: " . $line[1] . "</h3><h3 style='color: rgb(243, 227, 5);'>ระดับความพึงพอใจ :" . $line[2]." ดาว</h3><hr>";
                  }
                }
                fclose($file);
            ?>
          </div>
          <button class="accordion">ข้อร้องเรียนจากผู้ใช้</button>
          <div class="panel">
            <?php
              if (isset($_POST['delete'])) {
                $index = $_POST['index'];
                $lines = file("appeal.txt");
                unset($lines[$index]);
                file_put_contents("appeal.txt", $lines);
              }
              $file = fopen("appeal.txt", "r");
              $i = 0;
              while (!feof($file)) {
                $line = fgets($file);
                $line = explode("-", $line);
                if (count($line) >= 2) {
                  echo "<h3><b><a style='color: rgb(27, 27, 147);'>" . $line[0] . "</b></a>: " . $line[1] . "</h3>";
                  echo "<form action='' method='post'>";
                  echo "<input type='hidden' name='index' value='$i'>";
                  echo "<button class='btn btn-danger'type='submit' name='delete'>Delete</button><hr>";
                  echo "</form>";
                  $i++;
                }
              }
              fclose($file);
            ?>
            <div class="panel">
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small class="text-muted">11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                Hello, world! This is a toast message.
              </div>
            </div>
          </div>
   

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script>
  var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.display === "block") {
        panel.style.display = "none";
      } else {
        panel.style.display = "block";
      }
    });
  }
</script>
</body>
</html>
