<?php

session_start();

if (isset($_POST['username'])) {

    $isOK = true;

    require_once "dbconnect.php";
    
    //reCaptcha validation
    $secret = "6Ld_VhYTAAAAAEN8rcK-QyM37Fk_aAjfI-9cFgMJ";

    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);

    $decode = json_decode($check);

    if ($decode->success == false) {
        $isOK = false;
        $_SESSION['e_bot'] = "Prove you are not a bot!";
    }

    if (db_connect()) {

        $username = $_POST['username'];
        $pass1 = $_POST['pass1'];
        $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
        $email = $_POST['email'];

        if ($isOK == true) {
            if (db_query("INSERT INTO users VALUES (NULL,'$username', '$pass_hash', '$email', 1)")) {
                $_SESSION['username'] = true;
                header('Location:signup.php');
            }
        }
    }
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css.css">
    <link href="https://file.myfontastic.com/wm2GVTEBGPeHkdyNEkiD2P/icons.css" rel="stylesheet">
</head>
<title>MagLinker.pl - Sign up page</title>
<body>
<div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">MagLinker.pl</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="tutorial.php">Tutorial</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['logged'])) { ?>
                        <?php if (isset($_SESSION['admin'])) { ?>
                            <li><a href="mailbox.php"><span class="glyphicon glyphicon-envelope"></span> Mailbox</a></li>
                        <?php } ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="glyphicon glyphicon-user"></span> Logged as: <?php echo $_SESSION['username']; ?>
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="panel.php"><span class="glyphicon glyphicon-wrench"></span> Settings</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="addwarehouse.php"><span class="glyphicon glyphicon-home"></span> Add
                                        Warehouse</a>
                                </li>
                                <li><a href="addproduct.php"><span class="glyphicon glyphicon-shopping-cart"></span> Add
                                        Product</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Sign out</a></li>
                            </ul>
                        </li>
                    <?php } else {?>
                        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div id="content">
        <div class="row">
            <div class="col-12-sm">
                <div class="well">
                    <div class="page-header">
                        <h1>Join us right now!
                            <small>Create a new account.</small>
                        </h1>
                    </div>

                    <p class="lead">We are still in testing phase. Keep in mind that something sometimes
                        can go wrong, we are apologize for any circumstances which can occur in near future. Our service
                        is 100%
                        free.</p>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <form name="signupForm" action="signup.php" class="form-signin" onsubmit="return validateSignup(this);"
                      method="post">
                    <h2>Register for free!</h2>
                    <label for="inputLogin" class="sr-only">Login</label>
                    <input type="text" name="username" class="form-control" placeholder="Username"><span id="errMsg"
                                                                                                         class="error"></span>
                    <label for="inputPassword1" class="sr-only">Password</label>
                    <input type="password" name="pass1" class="form-control" placeholder="Your password">
                    <label for="inputPassword2" class="sr-only">Confirm password</label>
                    <input type="password" name="pass2" class="form-control" placeholder="Confirm password"><span
                        id="errPwd"
                        class="error"></span>
                    <label for="inputEmail" class="sr-only">E-mail</label>
                    <input type="text" name="email" class="form-control" placeholder="E-mail"><span id="errEM"
                                                                                                    class="error"></span>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="reg"> I agree the Terms.<span id="errChkbx"
                                                                                       class="error"></span>
                        </label>
                    </div>
                    <div class="g-recaptcha" id="rcaptcha"
                         data-sitekey="6Ld_VhYTAAAAADcvIPQGZnEUBTthfKWRHrK6Q3iU"></div>
                    <span id="captcha" class="error"></span>
                    <br/>
                    <button class="btn btn-lg btn-primary btn-block" onclick="" type="submit">Sign Up</button>

                </form>

            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-7">
                <h2><span class="glyphicon glyphicon-map-marker"></span> Our Location
                    <small>Visit us if you want to!</small>
                </h2>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9736.745022254749!2d17.078207199999998!3d52.40330049999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4704593117239869%3A0x03fed5b30f60be13!2sWilko%C5%84skich+5%2C+62-020+Swarz%C4%99dz!5e0!3m2!1spl!2spl!4v1456169229600&output=embed"
                    width="100%" height="300" frameborder="0" style="border:0" allowfullscreen
                "></iframe>
            </div>
        </div>

    </div>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h4>About Us</h4>
                <p>If you have any further questions contact us:</p>
                <p>
                    Phone: (+48) 881 942 510 <br/>
                    Email: <a href="mailto:contact@wsobiak.pl">contact@wsobiak.pl</a> <br/><br/>
                    Address <br/>
                    Wilkońskich 5 <br/>
                    62-020 Swarzędz <br/>
                    PL, Poland
                </p>
            </div>
            <div class="col-sm-4">
                <h4>Navigation</h4>
                <ul class="unstyled">
                    <li><a href="index.php">Home Page</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="tutorial.php">Tutorial</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="col-sm-4">
                <h4>Follow Us</h4>
                <ul class="unstyled">
                    <li><a href="#"><span class="icon-twitter-1"></span> Twitter</a></li>
                    <li><a href="#"><span class="icon-facebook-1"></span> Facebook</a></li>
                    <li><a href="#"><span class="icon-gplus"></span> Google Plus</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <h6>Copyright &copy; 2016 MagLinker.pl</h6>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/validate.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
