<?php 
session_start(); 
require_once('php-line-login-main/LineLogin.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="Login_v18/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="Login_v18/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v18/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v18/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v18/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="Login_v18/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v18/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v18/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v18/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="Login_v18/css/util.css">
	<link rel="stylesheet" type="text/css" href="Login_v18/css/main.css">
<!--===============================================================================================-->	
    <link rel="stylesheet" href="css/signin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> 
    <meta name="google-signin-client_id" content="539094943392-rj4ps1m0s6qpuieo661v95995jj50953.apps.googleusercontent.com">

</head>
<body>
    <div class="topnav">
        <a href="Home.php">Home</a>
        <a href="visitor_page/news.php">News</a>
        <a href="user/Book_course.php">Book Course</a>
            <div class="topnav-right">
                <a class="active" href="#">Log in</a>
                <a href="signup.php">Sign Up</a>
            </div><br>
    </div>
</body>
<body style="background-color: #666666;">  
                <div class="limiter">
                    <div class="container-login100">
                        <div class="wrap-login100">
                            <form class="login100-form validate-form" action="signin_db.php" method="post">
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
                                <span class="login100-form-title p-b-43">
                                    Login to continue
                                </span>
                                
                                
                                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                                    <input class="input100" type="email" name="email">
                                    <span class="focus-input100"></span>
                                    <span class="label-input100">Email</span>
                                </div>
                                
                                
                                <div class="wrap-input100 validate-input" data-validate="Password is required">
                                    <input class="input100" type="password" name="password">
                                    <span class="focus-input100"></span>
                                    <span class="label-input100">Password</span>
                                </div>
                                <div class="g-recaptcha" data-sitekey="6LcQrzIkAAAAALHzfgyVTdrihUbHL9fWZsktqZAz"></div>
                                <div class="flex-sb-m w-full p-t-3 p-b-32">
                                    <div class="contact100-form-checkbox">
                                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                                        <label class="label-checkbox100" for="ckb1">
                                            Remember me
                                        </label>
                                    </div>

                                    <div>
                                        <a href="signup.php" class="txt1">
                                            สมัครสมาชิก?
                                        </a>
                                    </div>
                                </div>
                        

                                <div class="container-login100-form-btn">
                                    <button type="submit" name="signin" class="login100-form-btn">
                                        Login
                                    </button>
                                </div>
                                
                                <div class="text-center p-t-46 p-b-20">
                                    <span class="txt2">
                                        or sign up using
                                    </span>

                                <div class="login100-form-social flex-c-m">
                                </div>
                                </form>
                                <?php 
                                    if (!isset($_SESSION['profile'])) {
                                        $line = new LineLogin();
                                        $link = $line->getLink();
                                ?>
                                <a href="<?php echo $link; ?>"><img src="img/btn_login_base.png"></a>
                                <?php }?><hr>
                                <div id="my-signin2"></div>
                                    <script>
                                        function onSuccess(googleUser) {
                                        console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
                                        }
                                        function onFailure(error) {
                                        console.log(error);
                                        }
                                        function renderButton() {
                                        gapi.signin2.render('my-signin2', {
                                            'scope': 'profile email',
                                            'width': 240,
                                            'height': 50,
                                            'longtitle': true,
                                            'theme': 'dark',
                                            'onsuccess': onSuccess,
                                            'onfailure': onFailure
                                        });
                                        }
                                    </script>

  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
                
                            </div>
                                        
                            <div class="login100-more" style="background-image: url('FormSignup/images/sp1.jpg');">
                            </div>
                        </div>
                    </div>
                </div>


    <!--===============================================================================================-->
		<script src="Login_v18/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
		<script src="Login_v18/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
		<script src="Login_v18/vendor/bootstrap/js/popper.js"></script>
		<script src="Login_v18/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
		<script src="Login_v18/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
		<script src="Login_v18/vendor/daterangepicker/moment.min.js"></script>
		<script src="Login_v18/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
		<script src="Login_v18/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
		<script src="Login_v18/js/main.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>  
</body>
</html>