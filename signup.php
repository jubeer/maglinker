<?php

session_start();

if (isset($_POST['username'])) {
    require_once "dbconnect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($connection->connect_errno != 0) {
        echo "Error: " . $connection->connect_errno;
    } else {
        $username = $_POST['username'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $email = $_POST['email'];

        if ($pass1 == $pass2) {
            $pass = $pass1;
        } else {
            header('Location:signup.php');
        }

        if ($connection->query("INSERT INTO users VALUES (NULL,'$username', '$pass', '$email', 1)")) {
            $_SESSION['username'] = true;
            header('Location:signup.php');
        }
    }
    $connection->close();
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
<title>MagLinkere.pl - Adding Warehouse</title>
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
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
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
                    </div><!-- end page-header -->

                    <p class="lead">We are still in testing phase. Keep in mind that something sometimes
                        can go wrong, we are apologize for any circumstances which can occur in near future. Our service
                        is 100%
                        free.</p>

                </div><!-- end well -->

            </div><!-- end col-12 -->
        </div>
        <div class="row">
            <div class="col-sm-4">
                <form action="signup.php" class="form-signin" method="post">
                    <h2>Register for free!</h2>
                    <label for="inputLogin" class="sr-only">Login</label>
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    <label for="inputPassword1" class="sr-only">Password</label>
                    <input type="password" name="pass1" class="form-control" placeholder="Your password">
                    <label for="inputPassword2" class="sr-only">Confirm password</label>
                    <input type="password" name="pass2" class="form-control" placeholder="Confirm password">
                    <label for="inputEmail" class="sr-only">E-mail</label>
                    <input type="text" name="email" class="form-control" placeholder="E-mail">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="reg"/> Agree terms.
                        </label>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6Lfc7BYTAAAAADSFJGrYUFBQH2pgdYblKQK8m_5k"></div>
                    <br/>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>

                </form>

            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-7">
                <h2><span class="glyphicon glyphicon-map-marker"></span> Our Location
                    <small>Visit us if you want to!</small>
                </h2>
                <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3442.6249297394806!2d17.076156556604747!3d52.40117668790244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4704593117239869%3A0x3fed5b30f60be13!2sWilko%C5%84skich+5%2C+62-020+Swarz%C4%99dz%2C+Polska!5e0!3m2!1spl!2sca!4v1454354171280"></iframe>

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
                    Adress <br/>
                    Wilkońskich 5 <br/>
                    62-020 Swarzędz <br/>
                    PL, Poland
                </p>
            </div><!-- end col-sm-4 -->
            <div class="col-sm-4">
                <h4>Navigation</h4>
                <ul class="unstyled">
                    <li><a href="index.php">Home Page</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div><!-- end col-sm-2 -->

            <div class="col-sm-4">
                <h4>Follow Us</h4>
                <ul class="unstyled">
                    <li><a href="#"><span class="icon-twitter-1"></span> Twitter</a></li>
                    <li><a href="#"><span class="icon-facebook-1"></span> Facebook</a></li>
                    <li><a href="#"><span class="icon-gplus"></span> Google Plus</a></li>
                </ul>
            </div><!-- end col-sm-2 -->
        </div><!-- end row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <h7>Copyright &copy; 2016 MagLinker.pl</h7>
                </div>
            </div><!-- end col-sm-2 -->
        </div><!-- end row -->
    </div><!-- end container -->
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
