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
<title>MagLinker.pl Project</title>
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
    <div class="row" id="bigCallout">
        <div class="col-12">

            <!-- Visible only on small devices -->
            <div class="well well-small visible-sm">
                <a href="" class="btn btn-large btn-block btn-default"><span class="glyphicon glyphicon-phone"></span>
                    Give us a call!</a>
            </div><!-- end well-small -->

            <div class="well">
                <div class="page-header">
                    <h1>A Fancy Header
                        <small>A subheader for extra awesome.</small>
                    </h1>
                </div><!-- end page-header -->

                <p class="lead">Some solid leading copy will help get your users engaged. Use this area to come up with
                    something real nice. Know what I'm sayin?</p>

                <a href="" class="btn btn-large btn-primary" id="alertMe">Click a nice big button</a>
                <a href="" class="btn btn-large btn-link">or a secondary link</a>
            </div><!-- end well -->

        </div><!-- end col-12 -->
    </div><!-- end bigCallout -->
    <div class="container">

        <form class="form-signin" action="login.php" method="post">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputLogin" class="sr-only">Login</label>
            <input type="text" name="login" class="form-control" placeholder="Login">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="pass" class="form-control" placeholder="Password">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <?php

            if (isset($_SESSION['error'])) echo "<p style='text-align: center'>" . $_SESSION['error'] . "</p>";

            ?>
        </form>

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
