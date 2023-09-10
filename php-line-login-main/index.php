<?php
session_start();
require_once('LineLogin.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Login</title>
    <link rel="stylesheet" href="../css/signin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="topnav">
        <a class="active" href="#home">Home</a>
        <a href="user/news.php">News</a>
        <a href="user/Book_course.php">Book Course</a>
      <div class="topnav-right">
        <?php 
            if (!isset($_SESSION['profile'])) {
                $line = new LineLogin();
                $link = $line->getLink();
        ?>
        <a href="<?php echo $link; ?>">Line Login</a>
        <?php } else { ?>
          <a href="user/profile.php" class="d-block"><?php echo $profile->name; ?></a>
          <a class="btn btn-danger" href="logout.php">Logout</a>
        <?php } ?>
      </div>
  </div>
    <main class="container">
    <div class="bg-light p-5 rounded">
        <h1>Welcome, to Line Login Web App</h1>
        <p class="lead">Let's login to the web by using line login.</p>
    </div>
    </main>

    
</body>
</html>