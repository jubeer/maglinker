<?php

session_start();

if (isset($_POST['wh_name'])) {
    require_once "dbconnect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($connection->connect_errno != 0) {
        echo "Error: " . $connection->connect_errno;
    } else {
        $wh_name = $_POST['wh_name'];
        $type = $_POST['type'];
        $wh_description = $_POST['wh_description'];

        if ($connection->query("INSERT INTO warehouses VALUES (NULL,'$wh_name', '$type', '$wh_description', 1)")) {
            $_SESSION['wh_added'] = true;
            header('Location:addwarehouse.php');
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
                <a class="navbar-brand" href="index.php">MagLinker.pl</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                            class="glyphicon glyphicon-user"></span> My Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="panel.php"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="addwarehouse.php"><span class="glyphicon glyphicon-home"></span> Add Warehouse</a>
                        </li>
                        <li><a href="addproduct.php"><span class="glyphicon glyphicon-shopping-cart"></span> Add Product</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Sign out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-12-sm">
            <div class="well">
                <div class="page-header">
                    <h1>Build your database!
                        <small>Create a new warehouse.</small>
                    </h1>
                </div><!-- end page-header -->

                <p class="lead">Fill the form below and store all you product information. </p>

            </div><!-- end well -->

        </div><!-- end col-12 -->
    </div>


    <div class="row">
        <div class="col-sm-4">
            <form action="addwarehouse.php" class="form-warehouses" method="post">
                <h2>Add a new warehouse:</h2>
                <label for="inputWHname" class="sr-only">Login</label>
                <input type="text" name="wh_name" class="form-control" placeholder="Warehouse name"><span
                    id="nameErrMsg" class="error"></span>
                <label for="inputType" class="sr-only">Type</label>
                <input type="text" name="type" class="form-control" placeholder="Type">
                <label for="inputCapacity" class="sr-only">Describe your warehouse...</label>
                <textarea name="wh_description" class="form-control"
                          placeholder="Describe your warehouse..."></textarea>
                <br/>
                <button class="btn btn-lg btn-warning btn-block" type="submit">Create Warehouse</button>
            </form>
            <br/>
            <form action="delete_db.php" class="form-warehouses" method="post">
                <button class="btn btn-lg btn-danger btn-block" type="submit">DELETE DB WAREHOUSES</button>
            </form>
        </div>
        <div class="col-sm-8">
            <h2>List of your current warehouses:</h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><strong>ID</strong></th>
                        <th><strong>Name</strong></th>
                        <th><strong>Type</strong></th>
                        <th><strong>Description</strong></th>
                        <th><strong>User</strong></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once "dbconnect.php";
                    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

                    if ($connection->connect_errno != 0) {
                        echo "Error: " . $connection->connect_errno;
                    } else {
                        if ($result = $connection->query("SELECT id, name, type, description, id_user FROM warehouses ORDER BY id ASC")) {
                            /* Przetwarzanie wierszy wyniku zapytania */

                            while ($row = $result->fetch_assoc()) { ?>

                                <tr>
                                    <td><strong><?php echo $row['id'] ?></strong></td>
                                    <td><strong><?php echo $row['name'] ?></strong></td>
                                    <td><strong><?php echo $row['type'] ?></strong></td>
                                    <td><strong><?php echo $row['description'] ?></strong></td>
                                    <td><strong><?php echo $row['id_user'] ?></strong></td>
                                </tr>
                                <?php
                            }


                            /* Usuwamy wynik zapytania z pamięci */

                            $result->close();
                        }
                    }
                    ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-1"></div>
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
</body>
</html>
