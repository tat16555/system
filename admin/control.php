<?php 

    session_start();
    include_once '../config/dbConfig.php';
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
  <title>News post</title>

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
<?php 
    if (isset($_SESSION['admin_login'])) {
        $admin_id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT * FROM admin WHERE id = $admin_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>

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
      if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM images WHERE id = '$delete_id'";
        if ($db->query($sql) === TRUE) {
          $_SESSION['statusMsg'] = "Record deleted successfully!";
          exit;
          header("Location: control.php");
        } else {
          echo "Error deleting record: " . $db->error;
        }
      }
    ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">News post</h1><a href="View_Post.php"><button type="button" class="btn btn-warning">View Post</button></a>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <form action="upload.php" method="POST" enctype="multipart/form-data">
                        <div class="text-center justify-content-center align-items-center p-4 border-2 border-dashed rounded-3">
                            <h6 class="my-2">Select image file to upload</h6>
                            <input type="file" name="file" class="btn btn-sm btn-primary mb-3" accept="image/gif, image/jpeg, image/png">
                            <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
                            <h5>หัวข้อข่าว :<input type="text" for="headlines" id="headlines" name="headlines" class="form-control streched-link"></h5>
                            <h5>เนื้อหา :<input type="text" for="content" id="content" name="content" class="form-control streched-link"></h5>
                          <input type="submit" name="submit" value="Upload" class="btn btn-primary">
                          <a href="View_Post.php"><button type="button" class="btn btn-warning">View Post</button></a>
                        </div>
                    </form>
      </div><!-- /.container-fluid -->
    </div>
            <table class="table">
            <thead>
                <tr>
                    <th>
                    </form>
                    </th>
                </tr>
                <tr>    
                    <th scope="col">#</th>
                    <th scope="col">หัวข้อ</th>
                    <th scope="col">เนื้อหา</th>
                    <th scope="col">image</th>
                    <th scope="col">เวลาที่ลง</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php 
                            echo $_SESSION['statusMsg']; 
                            unset($_SESSION['statusMsg']);
                        ?>
                    </div>
                <?php } ?>
                <?php 
                    $query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");
                    if ($query->num_rows > 0) {
                        while($row = $query->fetch_assoc()) {
                            $imageURL = '../img/uploads/'.$row['file_name'];
                            $id = $row['id'];
                            $headlines = $row['headlines'];
                            $content = $row['content'];
                            $uploaded_on = $row['uploaded_on'];                       
                        ?>
                    <tr id="myMenu">
                        <td><?php echo $id ?></td> 
                        <td><?php echo $headlines ?></td>   
                        <td><?php echo $content ?></td>               
                        <td><img src="<?php echo $imageURL ?>" alt="" width="10%" class="card-img"></td>
                        <td><?php echo $uploaded_on ?></td>        
                        <td><a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>                       </td>
                    </tr>
                    <?php 
                        }
                    } else { ?>
                    <p>No image found...</p>
                <?php } ?>
            </tbody>
            </table>
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
