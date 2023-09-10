<?php 

    session_start();
    require_once '../config/course_information.php';
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
    <title>Book course</title>
    
    <link rel="icon" type="../image/png" href="../Login_v18/images/icons/favicon.ico"/>
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="stylesheet" href="../css/FormQR.css">
    <link rel="stylesheet" href="../css/Book_course.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<?php
        if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $comment = $_POST['comment'];
                $file = fopen("appeal.txt", "a");
                fwrite($file, $name . "-" . $comment . "\n");
                fclose($file);
            }
        ?>
<body>
    <div class="container">
        <?php 
            if (isset($_SESSION['user_login'])) {
                $user_id = $_SESSION['user_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        ?>
    </div>
    <div class="topnav">
        <a href="../user.php">Home</a>
        <a href="news.php">News</a>
        <a class="active" href="Book_course.php">Book Course</a>
            <div class="topnav-right">
                <a href="profile.php">User <?php echo $row['username'] ?></a>
                <a href="../logout.php" class="btn btn-danger">Logout</a><br>
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
            <br><br><hr>
            <h1 style="text-align: center;">เรียนมวยไทยได้ง่ายๆ เพียงแค่คุณกดจอง</h1>
                <hr>
            <?php 
                    $conn = new PDO("mysql:host=$servername;dbname=data_studio", $username, $password);
                    $stmt = $conn->query("SELECT * FROM course");
                    $stmt->execute();
                    $course = $stmt->fetchAll();

                    if (!$course) {
                        echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                    } else {
                    foreach($course as $course)  {  
                ?>
            <section style="background-color: #eee;">
                <div class="container py-5">
                    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card text-black">
                        <i class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>
                        <?php echo $course['img']; ?>
                        <div class="card-body">
                            <div class="text-center">
                            <h5><?php echo $course['Cou_Name']; ?></h5><br>
                            <h6>รายระเอียดคอร์สเรียน</h6><hr>
                            <p><?php echo $course['details']; ?></p>
                            </div>
                            <div class="d-flex justify-content-between total font-weight-bold mt-4">
                            <span>ราคา</span><span><?php echo $course['price']; ?> THB</span>
                            </div><hr>
                            <div class="d-flex justify-content-between total font-weight-bold mt-4">
                            <a class="grey"><a href="Book_course2.php?id_Cou=<?=$course['id_Cou']?>" class="btn btn-success">จองคอร์ส</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>
            <?php }  } ?>
            </div>
        <script src="../JS/Home.js"></script>
</body>
</html>