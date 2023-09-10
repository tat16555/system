<?php 
    session_start(); 
    include_once '../config/dbConfig.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="../css/signin.css">
        <link rel="stylesheet" href="../css/news_Sy.css">
        <link rel="stylesheet" href="../css/signincontrol.css">
        <link rel="icon" type="image/png" href="Login_v18/images/icons/favicon.ico">  
        <style>
            * {
            box-sizing: border-box;
            }

            body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            }

            .header {
            text-align: center;
            padding: 32px;
            }

            .row {
            display: -ms-flexbox; /* IE 10 */
            display: flex;
            -ms-flex-wrap: wrap; /* IE 10 */
            flex-wrap: wrap;
            padding: 0 4px;
            }

            /* Create two equal columns that sits next to each other */
            .column {
            -ms-flex: 50%; /* IE 10 */
            flex: 50%;
            padding: 0 4px;
            }

            .column img {
            margin-top: 8px;
            vertical-align: middle;
            }

            /* Style the buttons */
            .btn {
            border: none;
            outline: none;
            padding: 10px 16px;
            background-color: #f1f1f1;
            cursor: pointer;
            font-size: 18px;
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
        <?php  if (!empty($_SESSION['statusMsg'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php 
                            echo $_SESSION['statusMsg']; 
                            unset($_SESSION['statusMsg']);
                ?>
            </div>
        <?php } ?>
    </head>
    <?php
        if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $comment = $_POST['comment'];
                $file = fopen("../appeal.txt", "a");
                fwrite($file, $name . "-" . $comment . "\n");
                fclose($file);
            }
        ?>
<body>
        <div class="topnav">
            <a href="../Home.php">Home</a>
            <a class="active" href="#news">News</a>
            <a href="../user/Book_course.php">Book a course</a>
                <div class="topnav-right">
                    <a href="../signin.php">Log in</a>
                    <a href="../signup.php">Sign Up</a>
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
        <body>
                <div class="row">
                </div>

                <div class="leftcolumn">
                <div class="card">
                        <h1>News Thai boxing</h1>
                </div>
                        <?php 
                            $query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");
                            if ($query->num_rows > 0) {
                                while($row = $query->fetch_assoc()) {
                                    $imageURL = '../img/uploads/'.$row['file_name'];
                                    $headlines = $row['headlines'];
                                    $content = $row['content'];
                                    $uploaded_on = $row['uploaded_on']; 
                                ?>
                        <div class="card">
                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="card shadow h-100">                                     
                                        <h2 style="text-align:left;" ><?php echo $headlines ?><br></h2><p style="text-align:left;"><?php echo $content ?></p><br><img src="<?php echo $imageURL ?>" alt="" width=" 80%" text-align=" center"  class="card-img"><br><p class="btn btn-sm btn-primary mb-3">อัพโหลดเมื่อ : <?php echo $uploaded_on ?></p><hr>
                                    </div>
                                </div>
                        </div>
                            <?php 
                                }
                            } else { ?>
                            <p>No image found...</p>
                        <?php } ?>  
                    </div>
                </div>
                </div>
                    <div class="rightcolumn">
                        <div class="card">
                        <h2>Thai boxing</h2>
                        <img src="../img/img_home/TB66666666666.jpg" style="width:100%">
                    </div>
                        <div class="card">                                
                            <div class="fakeimg"><img src="../img/img_home/GMLive-woman-we-love-muay-thai-beauty04.jpg" style="width:100%"></div><br>
                            <div class="fakeimg"><img src="../img/img_home/TB3214.jpg" style="width:100%"></div><br>
                            <div class="fakeimg"><img src="../img/img_home/TB322222222222222.jpg" style="width:100%"></div><br>
                            <div class="fakeimg"><img src="../img/img_home/TB09213.jpg" style="width:100%"></div>
                            <div class="fakeimg"><img src="../img/img_home/TB0942532.jpg" style="width:100%"></div>
                        </div>
                </div><hr>
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