<?php

session_start();

if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
} else {
    if (isset($_POST['p_name'])) {
        require_once "dbconnect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        $connection = @new mysqli($host, $db_user, $db_password, $db_name);

        if ($connection->connect_errno != 0) {
            echo "Error: " . $connection->connect_errno;
        } else {
            $p_name = $_POST['p_name'];
            $qty = $_POST['qty'];
            $keywords = $_POST['keywords'];
            $id_wh = $_POST['id_wh'];

            if ($connection->query("INSERT INTO products VALUES (NULL,'$p_name', '$qty', '$keywords', '$id_wh')")) {
                header('Location:addproduct.php');
            }
        }
        $connection->close();
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
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                                class="glyphicon glyphicon-user"></span> Logged as: <?php echo $_SESSION['username']?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="panel.php"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="addwarehouse.php"><span class="glyphicon glyphicon-home"></span> Add Warehouse</a>
                            </li>
                            <li><a href="addproduct.php"><span class="glyphicon glyphicon-shopping-cart"></span> Add
                                    Product</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Sign out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
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
            <form action="addproduct.php" class="form-custom" method="post">
                <h2>Add a new product:</h2>
                <label for="selectWarehouse" class="sr-only">Select warehouse</label>
                <select name="id_wh" class="form-control">
                    <option value="" disabled selected>Select warehouse</option>
                    <?php
                    require_once "dbconnect.php";
                    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
                    $id_user = $_SESSION['id'];
                    if ($connection->connect_errno != 0) {
                        echo "Error: " . $connection->connect_errno;
                    } else {
                        if ($result = $connection->query("SELECT id, name FROM warehouses WHERE id_user='$id_user' ORDER BY id ASC")) {
                            /* Przetwarzanie wierszy wyniku zapytania */

                            while ($row = $result->fetch_assoc()) {?>

                                <option value="<?php echo $row['id'];?>"><?php echo "ID: " . $row['id'] . " " . $row['name']?></option>
                            <?php
                            }
                            $result->close();
                        }
                    }
                    ?>
                </select>
                <label for="inputWHID" class="sr-only">Product name</label>
                <input type="text" name="p_name" class="form-control" placeholder="Product name">
                <label for="inputType" class="sr-only">Quantity</label>
                <input type="text" name="qty" class="form-control" placeholder="Quantity">
                <label for="inputKeywords" class="sr-only">Keywords</label>
                <textarea name="keywords" class="form-control"
                          placeholder="Type keywords, use ';' as a separator..."></textarea>
                <br/>
                <button class="btn btn-lg btn-warning btn-block" type="submit">Create Product</button>
            </form>
            <br/>
            <form action="delete_db_products.php" class="form-custom" method="post">
                <button class="btn btn-lg btn-danger btn-block" type="submit">DELETE DB PRODUCTS</button>
            </form>
        </div>
        <div class="col-sm-8">
            <h2>List of your current products:</h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><strong>ID</strong></th>
                        <th><strong>Name</strong></th>
                        <th><strong>Quantity</strong></th>
                        <th><strong>Keywords</strong></th>
                        <th><strong>Warehouse</strong></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once "dbconnect.php";
                    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
                    $id_user = $_SESSION['id'];
                    if ($connection->connect_errno != 0) {
                        echo "Error: " . $connection->connect_errno;
                    } else {
                        if ($result = $connection->query("SELECT p.id, p.name, p.quantity, p.keywords, p.id_warehouse, warehouses.name as wh_name FROM products p JOIN warehouses ON warehouses.id=p.id_warehouse WHERE warehouses.id_user='$id_user' ORDER BY id_warehouse ASC")) {
                            /* Przetwarzanie wierszy wyniku zapytania */

                            while ($row = $result->fetch_assoc()) { ?>

                                <tr>
                                    <td><strong><?php echo $row['id'] ?></strong></td>
                                    <td><strong><?php echo $row['name'] ?></strong></td>
                                    <td><strong><?php echo $row['quantity'] ?></strong></td>
                                    <td><strong><?php echo $row['keywords'] ?></strong></td>
                                    <td><strong><?php echo $row['wh_name'] ?></strong></td>
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