<?php
session_start();

if (isset($_SESSION['logged']) && ($_SESSION['logged'] == true)) {
    header('Location: panel.php');
    exit();
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
<title>MagLinker.pl Project - Home Page</title>
<body>
<div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">MagLinker.pl</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Page 1-1</a></li>
                        <li><a href="#">Page 1-2</a></li>
                        <li><a href="#">Page 1-3</a></li>
                    </ul>
                </li>
                <li><a href="#">API</a></li>
                <li><a href="panel.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
            </ul>
        </div>
    </nav>
    <!--- Header #1 -->
    <div class="row">
        <div class="col-12-sm">

            <!-- Visible only on small devices -->
            <div class="well well-small visible-sm">
                <a href="" class="btn btn-large btn-block btn-default"><span class="glyphicon glyphicon-phone"></span> Give us a call!</a>
            </div><!-- end well-small -->

            <div class="well">
                <div class="page-header">
                    <h1>Check our awesome website! <small>Keep your products in one place.</small></h1>
                </div><!-- end page-header -->

                <p class="lead">We are proud to present our new product which is MagLinker - simple storage for your products.<br />You can check the tutorial video or just sign up today!</p>

                <a href="signup.php" class="btn btn-large btn-primary">Join us today</a>
                <a href="tutorial.php" class="btn btn-large btn-link">or check our video tutorial first</a>
            </div><!-- end well -->

        </div><!-- end col-12 -->
    </div><!-- end bigCallout -->


    <div class="row">
        <div class="col-sm-4 feature">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Online WAREHOUSE</h3>
                </div><!-- end panel-heading -->
                <img src="images/badges_wh.jpg" alt="warehouse" class="img-circle">

                <p>You can create many warehouses to keep order of your products. Simply go directly to warehouse creation form!</p>

                <a href="addwarehouse.php" target="_blank" class="btn btn-warning btn-block">Create new WAREHOUSE</a>
            </div><!-- end panel -->
        </div><!-- end feature -->

        <div class="col-sm-4 feature">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Management PANEL</h3>
                </div><!-- end panel-heading -->
                <img src="images/badges_mg.jpg" alt="Management" class="img-circle">

                <p>The easiest way to manage your products. Check our management panel!</p>

                <a href="panel.php" target="_blank" class="btn btn-danger btn-block">Manage your WAREHOUSE</a>
            </div><!-- end panel -->
        </div><!-- end feature -->

        <div class="col-sm-4 feature">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Many PRODUCTS</h3>
                </div><!-- end panel-heading -->
                <img src="images/badges_ap.jpg" alt="New Product" class="img-circle">

                <p>Add a new product to your warehouse, keep all information about it in one place.</p>

                <a href="addproduct.php" target="_blank" class="btn btn-info btn-block">Add a new PRODUCTS</a>
            </div><!-- end panel -->
        </div><!-- end feature -->
    </div><!-- end features -->
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h4>About Us</h4>
                <p>If you have any further questions contact us:</p>
                <p>
                    Phone: (+48) 881 942 510 <br />
                    Email: <a href="mailto:contact@wsobiak.pl">contact@wsobiak.pl</a> <br /><br />
                    Adress <br />
                    Wilkońskich 5 <br />
                    62-020 Swarzędz <br />
                    PL, Poland
                </p>
            </div><!-- end col-sm-4 -->
            <div class="col-sm-4">
                <h4>Navigation</h4>
                <ul class="unstyled">
                    <li><a href="#">Home Page</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Links</a></li>
                    <li><a href="#">Contact</a></li>
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
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
