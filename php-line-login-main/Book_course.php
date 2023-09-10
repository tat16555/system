<?php 

    session_start();
    require_once '../config/course_information.php';
    require_once('LineLogin.php');

    if (!isset($_SESSION['profile'])) {
        header("location: ../signin.php");
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

            .floating-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            cursor: pointer;
            background-image: url(ic1.png);
            background-size: cover;
        }
        form {
            width: 100%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
            }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            }

        input[type="submit"]:hover {
            background-color: #3e8e41;
            }
</style>
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
<?php 
            if (isset($_SESSION['profile'])) {
                $profile = $_SESSION['profile'];
            }
        ?>
            <div class="topnav">
                    <a href="welcome.php">Home</a>
                    <a href="news.php">News</a>
                    <a class="active" href="Book_course.php">Book Course</a>
                <div class="topnav-right">
                    <?php 
                        if (!isset($_SESSION['profile'])) {
                            $line = new LineLogin();
                            $link = $line->getLink();
                    ?>
                    <a href="<?php echo $link; ?>">Line Login</a>
                    <?php } else { ?>
                    <a href="profile.php" class="d-block"><?php echo $profile->name; ?></a>
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                    <?php } ?>
                </div>
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
                <ul>
                    <li>คอร์สเรียน มีทั้งหมด 4 คอร์สเรียน ได้แก่</li>
                    <li>ยังไม่มีพื้นฐาน ( Basic/Beginner Class training )</li>
                    <li>มีพื้นฐานแล้ว ( Intermediate Class Training )</li>
                    <li>สำหรับนักมวยมืออาชีพหรือผู้ที่ฝึกทักษะป้องกันตัวแบบจริงจัง ( Advance Class Training )</li>
                    <li>เรียนตัวต่อตัว ( Private Training )</li>
                </ul>
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
            <div class="columns">
                <ul class="price">
                    <li class="header" style="background-color:#04AA6D"><?php echo $course['Type_Name']; ?></li>
                    <li class="grey"><?php echo $course['Cou_Name']; ?></li>
                    <li><p class="btn btn-warning">ราคา <?php echo $course['price']; ?> THB</p></li>
                    <li>รายระเอียดคอร์สเรียน</li>
                    <li><?php echo $course['details']; ?></li>
                    <li class="grey"><button class="btn btn-primary" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><i class="fa fa-bars"></i>จองคอร์ส</button><button class="btn btn-warning">ในราคา <?php echo $course['price']; ?> THB</button></li>
                </ul>              
            </div>
            <?php }  } ?>
            <div class="columns">
                <ul class="price">
                    <li class="header">จะมาในเร็วๆ นี้</li>
                    <li class="grey">ไม่พบข้อมูล</li>
                    <li><p class="btn btn-warning">ราคา???</p></li>
                    <li>รายระเอียดคอร์สเรียน</li>
                    <li>ไม่มีข้อมูลที่เป็นประโยชน์!%d</li><br><br><br><br>
                    <li class="grey"><button class="container" style="width:auto;"><i class="fa fa-bars"></i>จองคอร์ส</button><button class="btn btn-warning">ในราคา ??? THB</button></li>
                </ul>
            </div>
            <div class="columns">
                <ul class="price">
                    <li class="header">จะมาในเร็วๆ นี้</li>
                    <li class="grey">ไม่พบข้อมูล</li>
                    <li><p class="btn btn-warning">ราคา???</p></li>
                    <li>รายระเอียดคอร์สเรียน</li>
                    <li>ไม่มีข้อมูลที่เป็นประโยชน์!%d</li><br><br><br><br>
                    <li class="grey"><button class="container" style="width:auto;"><i class="fa fa-bars"></i>จองคอร์ส</button><button class="btn btn-warning">ในราคา ??? THB</button></li>
                </ul>
            </div>

            <div id="id01" class="modal"> 
            <form class="modal-content animate" action="/action_page.php" method="post">
                <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="QRimg/QR_Code1.png" alt="Avatar" class="avatar">
                </div>
                <div class="container">
                    <h2 style="text-align: center;">1,000 THB</h2>
                </div>
                <div class="container">     
                <button type="submit">ชำระเงินแล้ว</button>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                </div>
            </form>
            </div>
        <script>
            const floatingIcon = document.querySelector(".floating-icon");
            const messageBox = document.querySelector("#message-box");

            floatingIcon.addEventListener("click", function() {
            messageBox.style.display = messageBox.style.display === "none" ? "block" : "none";
            });
        </script>
        <script src="../JS/Home.js"></script>
</body>
</html>