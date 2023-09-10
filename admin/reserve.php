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
  <title>Reserve</title>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartkick"></script>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <?php 
    require_once "../config/course_information.php";

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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">กราฟ</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Successful transaction rate graph
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <?php require_once("chrat/chrat1.php"); ?>
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
                <?php require_once("chrat/chrat2.php"); ?>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Accordion Item #3
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
                </div>
            </div>
            </div>
      </div><!-- /.container-fluid --><hr>
      <h1 class="m-0">รายการธุรกรรม</h1><br>
      <div>
        <button type="button" class="btn btn-primary">All reserve: <?php echo $total_rows; ?></button>
        <button type="button" class="btn btn-success">Complete: <?php echo $complished_rows; ?></button>
        <button type="button" class="btn btn-danger">Failed: <?php echo $failed_rows; ?></button>
        <button type="button" class="btn btn-warning">Not verified: <?php echo $not_verified_rows; ?></button>
        <button type="button" class="btn btn-warning">Verified: <?php echo $verified; ?></button>

        <button type="button" class="btn btn-success">Complete: <?php echo $complished_percentage_formatted; ?>%</button>
        <button type="button" class="btn btn-danger">Failed: <?php echo $failed_percentage_formatted; ?>%</button>
      </div>
        <br>
      <table class="table">
        <thead class="table-success">
            <tr>
            <th colspan="9">
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
                    <th scope="col">เลขที่รายการ</th>
                    <th scope="col">id users</th>
                    <th scope="col">ชื่อ นามสกุล</th>
                    <th scope="col">เบอร์โทร</th>
                    <th scope="col">ชื่อคอร์ส</th>
                    <th scope="col">ชำระเงินผ่าน</th>
                    <th scope="col">ราคา</th>
                    <th scope="col">เลขอ้างอิง</th>
                    <th scope="col">สถาณะ</th>
                    <th scope="col">created_at</th>
                    <th scope="col">ตรวจสอบ</th>
                </tr>
            </thead>
            <?php 
                require_once "../config/course_information.php";
                if (isset($_POST['search'])) {
                    $search = $_POST['search'];
                    $stmt = $conn->query("SELECT * FROM reserve WHERE ID_Re  LIKE '%$search%' OR Cou_Name LIKE '%$search%' OR status LIKE '%$search%' ");
                } else {
                    $stmt = $conn->query("SELECT * FROM reserve");
                }

                $stmt->execute();
                $reserve = $stmt->fetchAll();
                $months = array();
                if (!$reserve) {
                    echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                } else {
                    foreach($reserve as $easy)  {  
                ?>
            <tbody class="table-info">
                    <tr id="myMenu">
                        <th scope="row"><?php echo $easy['ID_Re']; ?></th>
                        <td><?php echo $easy['id_users']; ?></td>
                        <td><?php echo $easy['first_name_surname']; ?></td>
                        <td><?php echo $easy['phone']; ?></td>
                        <td><?php echo $easy['Cou_Name']; ?></td>
                        <td><?php echo $easy['payment']; ?></td>
                        <td><?php echo $easy['price'].":THB"; ?></td>
                        <td><?php echo $easy['reference_number']; ?></td>
                          <?php
                            $status = $easy['status'];
                            if ($status == 'complished') {
                                // show green text for accomplished status
                                echo '<td style="color:green;">'.$status.'</td>';
                            } else if ($status == 'failed') {
                                // show red text for failed status
                                echo '<td style="color:red;">'.$status.'</td>';
                            } else if ($status == 'not verified') {
                              // show yellow text for failed status
                              echo '<td style="color:yellow;">'.$status.'</td>';
                          }else {
                                // show black text for all other statuses
                                echo '<td>'.$status.'</td>';
                            }
                          ?>
                        <!-- <td><?php echo $easy['status']; ?></td> -->
                        <td><?php echo $easy['created_at']; ?></td>
                        <?php
                          if ($easy['status'] == "not verified") {
                              // show confirm and invalid buttons but not verified button
                              ?>
                              <td>
                                <div class="dropdown">
                                  <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                  verification
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item" href="system_reserve_confirm.php?ID_Re=<?=$easy['ID_Re']; ?>">confirm</a></li>
                                    <li><a class="dropdown-item" href="system_reserve_invalid.php?ID_Re=<?=$easy['ID_Re']; ?>">invalid</a></li>
                                  </ul>
                                </div>
                              </td>

                              <?php
                          } else if ($easy['status'] == "complished") {
                              // show confirm and invalid buttons and hide verified button
                              ?>
                              <td scope="col"><a class="btn btn-info">verified</a></td>
                              <?php
                          } else if ($easy['status'] == "failed") {
                            // show confirm and invalid buttons and hide verified button
                            ?>
                            <td scope="col"><a class="btn btn-info">verified</a></td>
                            <?php
                        } 
                          ?>
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
