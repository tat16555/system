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
  <title>User</title>

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <style>
    .container {
      padding: 50px;
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
      <?php 
        $stmt = $conn->query("SELECT COUNT(*) as total_users FROM users");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_users = $row['total_users'];
      ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ข้อมูลผู้ใช้</h1><a href="user_information.php"><button type="button" class="btn btn-primary">เพิ่มผู้ใช้งาน</button></a><a class="btn btn-warning">จำนวนของ User <?php echo $total_users; ?>คน</a>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <?php
  $stmt = $conn->query("SELECT DATE_FORMAT(created_at, '%Y-%m') AS date, COUNT(*) as signups FROM users GROUP BY DATE_FORMAT(created_at, '%Y-%m')");
  $data = [];
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = [$row['date'], intval($row['signups'])];
  }
?>

<div id="signup-chart" style="min-width: 310px; height: 400px; margin: 0 auto; "></div>
    <script>
    Highcharts.chart('signup-chart', {
        chart: {
        type: 'column'
        },
        title: {
        text: 'Monthly Signups'
        },
        xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
            fontSize: '13px',
            fontFamily: 'Verdana, sans-serif'
            }
        }
        },
        yAxis: {
        min: 0,
        title: {
            text: 'Number of Signups'
        }
        },
        legend: {
        enabled: false
        },
        series: [{
        name: 'Signups',
        data: <?php echo json_encode($data); ?>,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}',
            y: 10,
            style: {
            fontSize: '13px',
            fontFamily: 'Verdana, sans-serif'
            }
        }
        }]
    });
    </script>
    </div>
<table class="table">
    <thead class="table-success">
        <tr>
          <th colspan="8">
          <form action="" method="post">
                <input class="form-control me-2" type="text" name="search" placeholder="Search for a user">     
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
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">username</th>
            <th scope="col">address</th>
            <th scope="col">phone</th>
            <th scope="col">email</th>	
            <th scope="col">created_at</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody class="table-info">
        <?php 
            if (isset($_POST['search'])) {
                $search = $_POST['search'];
                $stmt = $conn->query("SELECT * FROM users WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR username LIKE '%$search%' OR address LIKE '%$search%' OR phone LIKE '%$search%' OR email LIKE '%$search%' OR created_at LIKE '%$search%'");
            } else {
                $stmt = $conn->query("SELECT * FROM users");
            }

            $stmt->execute();
            $users = $stmt->fetchAll();
            $months = array();
            if (!$users) {
                echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
            } else {
                foreach($users as $user)  {  
        ?>
        
            <tr id="myMenu">
                <th scope="row"><?php echo $user['id']; ?></th>
                <td><?php echo $user['firstname']; ?></td>
                <td><?php echo $user['lastname']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['address']; ?></td>
                <td><?php echo $user['phone']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
                <td>
                    <a onclick="return confirm('Are you sure you want to Edit?');" href="update_user.php?id=<?=$user['id']?>" class="btn btn-warning">Edit</a>
                </td>
                <td><a onclick="return confirm('Are you sure you want to Delete?');" href="delete_user.php?id=<?=$user['id']?>" class="btn btn-danger">Delete</a></td> 
                </td>
            </tr>
        <?php }  } ?>
    </tbody>
</table>
    </div>
    <!-- /.content-header -->
  </div>
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
