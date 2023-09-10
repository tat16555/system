<?php 

    session_start();
    require_once 'config/db.php';
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
    <title>Home</title>
    
    <link rel="icon" type="image/png" href="Login_v18/images/icons/favicon.ico"/>
    <link rel="stylesheet" href="css/signin.css">
    <link rel="stylesheet" href="css/home.css">
    <img src="snowflake.png" alt="Snowflake" style="display: none;">

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
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
            if (isset($_SESSION['user_login'])) {
                $user_id = $_SESSION['user_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        ?>
    <body>
    <?php
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $comment = $_POST['comment'];
                $file = fopen("appeal.txt", "a");
                fwrite($file, $name . "-" . $comment . "\n");
                fclose($file);
            }
        ?>
    <div class="topnav">
        <a class="active" href="#home">Home</a>
        <a href="user/news.php">News</a>
        <a href="user/Book_course.php">Book Course</a>
            <div class="topnav-right">
                <a href="user/profile.php" class="d-block"><?php echo $row['username'] ?></a>
                <a class="btn btn-danger" href="logout.php">Logout</a>
            </div>
    </div>
    </body>
    <body onload="showPopup()">
    <div class="row">
        </div>
        <div class="leftcolumn">
            <div class="card">
                <h1 style="color: rgb(250, 0, 0);">ขุนศึกมวยไทย</h1>
                <p>ฝึกมวยไทยพื้นฐาน ที่ขุนศึกมวยไทย กระบี่</p>
                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                        <img src="img/img_home/h4.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="color: aliceblue;"> การแข่งขันมวยไทย</h5>
                        </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                        <img src="img/img_home/h5.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="color: aliceblue;">เป็นสุดยอดนักสู้</h5>
                        </div>
                        </div>
                        <div class="carousel-item">
                        <img src="img/img_home/h6.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="color: aliceblue;">ก้าวขั้นไปสู่ระดับโลก</h5>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>

            <br>
        </div>
            <div class="card">
                <h2>รับชมรีวิว</h2>
                <div class="ratio ratio-16x9">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/LRVYSnaXsvE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
            <div class="card">
                <h2>boxing stadium</h2>
                <h5>12/20/2022</h5>
                <img src="img/img_home/Thaiboxing321441.jpg" style="width:100%">
             </div>
             <div class="card">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        รีวิวเว็บไซต์ของเรา
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">  
                        <?php
                            if (isset($_POST['submit'])) {
                                $name = $_POST['name'];
                                $comment = $_POST['comment'];
                                $score = $_POST['score'];
                                $file = fopen("commentHome.txt", "a");
                                fwrite($file, $name . "-" . $comment . "-" . $score . "\n");
                                fclose($file);
                            }
                            ?>
                            <form action="" method="post">
                            <input type="hidden" name="name" value="<?php echo $row['username'] ?>">
                            <input type="text" class="form-control" name="comment" placeholder="Your Comment"></textarea>
                            <div class="form-check">     
                                <input type="radio" class="form-check-input" id="score" name="score" checked value="1 ">
                                <label class="form-check-label" for="score">1 ดาว</label>
                            </div>
                            <div class="form-check">     
                                <input type="radio" class="form-check-input" id="score" name="score"  value="2">
                                <label class="form-check-label" for="score1">2 ดาว</label>
                            </div>
                            <div class="form-check">     
                                <input type="radio" class="form-check-input" id="score" name="score"  value="3">
                                <label class="form-check-label" for="score">3 ดาว</label>
                            </div>
                            <div class="form-check">     
                                <input type="radio" class="form-check-input" id="score" name="score"  value="4">
                                <label class="form-check-label" for="score">4 ดาว</label>
                            </div>
                            <div class="form-check">     
                                <input type="radio" class="form-check-input" id="score" name="score"  value="5">
                                <label class="form-check-label" for="score">5 ดาว</label>
                            </div>
                            <input class="btn btn-primary" type="submit" name="submit">
                            </form><hr>              
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
                            ?></div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
            <div class="rightcolumn">
                <div class="card">
                <h2>Thai boxing</h2>
                <img src="img/img_home/TB66666666666.jpg" style="width:100%">
            </div>
                <div class="card">                                
                    <div class="fakeimg"><img src="img/img_home/GMLive-woman-we-love-muay-thai-beauty04.jpg" style="width:100%"></div><br>
                    <div class="fakeimg"><img src="img/img_home/TB3214.jpg" style="width:100%"></div><br>
                    <div class="fakeimg"><img src="img/img_home/TB322222222222222.jpg" style="width:100%"></div><br>
                    <div class="fakeimg"><img src="img/img_home/TB09213.jpg" style="width:100%"></div>
                    <div class="fakeimg"><img src="img/img_home/TB0942532.jpg" style="width:100%"></div>
                </div>
                <hr>
        </div>
        <div class="footer"><br>
                <h2>Thank you for visiting our website.<br>ขอบคุณสำหรับการเยี่ยมชมเว็บไซต์ของเรา<hr></h2>
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
            </div>
        <script>
            const floatingIcon = document.querySelector(".floating-icon");
            const messageBox = document.querySelector("#message-box");

            floatingIcon.addEventListener("click", function() {
            messageBox.style.display = messageBox.style.display === "none" ? "block" : "none";
            });
        </script>
        <script src="JS/Home.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
    
</html>