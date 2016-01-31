<?php
session_start();

if (!isset($_SESSION['logged']))
{
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<title>Marlive Project</title>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Marlive-Insider.pl</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Page 1-1</a></li>
                    <li><a href="#">Page 1-2</a></li>
                    <li><a href="#">Page 1-3</a></li>
                </ul>
            </li>
            <li><a href="#">Page 2</a></li>
            <li><a href="panel.php">Statistics</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logged as: <?php echo $_SESSION['login']?></a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
        </ul>
    </div>
</nav>
<?php
$goal = 0;
$active = 0;
$y_profits = 0;
$t_profits = 0;
$y_avgp = 0;
$user_id = '10805'; //Your Marlive account ID
$api_key = 'CFA8C199'; //Your API's KEY
$secret = '7877983069CBCF7B'; //Your API's secret code

$URL = 'https://marlive.com/api/list_deposits.php';
$data = array(

    'user_id' => $user_id,
    'api_key' => $api_key,
    'secret' => $secret
);
$URL = $URL . '?' . http_build_query($data, '', '&');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
ob_start();
$r = curl_exec($ch);
ob_end_clean();
curl_close($ch);
$result = json_decode($r);
//var_dump($result);

$BALANCE_URL = "https://marlive.com/api/balance.php";
$BALANCE_URL = $BALANCE_URL.'?'.http_build_query($data, '', '&');
$chb = curl_init ();
curl_setopt ($chb, CURLOPT_URL, $BALANCE_URL);
curl_setopt ($chb, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt ($chb, CURLOPT_RETURNTRANSFER, true);
ob_start();
$rb = curl_exec ($chb);
ob_end_clean();
curl_close ($chb);
$result_bal = json_decode($rb);?>
<div class="contrainer">
    <div class="row">
        <div class="col-md-12 jumbotron">
            <div class="text-center">
                <h1>Your BITCOIN balance</h1>
                <span style="font-size: 30px; color: darkgreen"><?php echo "$" . $result_bal->{'BITCOIN'}; ?></span><br /><br />
                <a href="index.php" class="btn btn-lg btn-success">REFRESH</a>
            </div>
        </div>
    </div>
</div>
<br /><br /><br />

<?php echo "</div><div class=\"container table-responsive\">
<table class=\"table table-hover\">
           <thead>
           <tr>
                <th><strong>DEPOSIT_ID</strong></th>
                <th><strong>$ AMOUNT</strong></th>
                <th><strong>GATEWAY</strong></th>
                <th><strong>$ YESTERDAY</strong></th>
                <th><strong>% YESTERDAY</strong></th>
                <th><strong>$ TOTAL</strong></th>
                <th><strong>% PROGRESS</strong></th>
                <th><strong>$ GOAL</strong></th>
            </tr>
            </thead>
            <tbody>";

foreach ($result as $object): ?>

    <tr>
        <td><strong><?php echo $object->{'DEPOSIT_ID'} ?></strong></td>
        <td><strong><?php echo "$" . sprintf("%01.4f", $object->{'AMOUNT'}) ?></strong></td>
        <td><strong><?php echo $object->{'GATEWAY'} ?></strong></td>
        <td><strong><?php echo "$" . $object->{'YESTERDAY_PROFITS'} ?></strong></td>
        <td><strong><?php echo $object->{'YESTERDAY_PROFITS_RATE'} ?></strong></td>
        <td><strong><?php echo "$" . $object->{'TOTAL_PROFITS'} ?> </strong></td>
        <td><strong><?php echo $object->{'TOTAL_PROFITS_RATE'} ?></strong></td>
        <td><strong><?php echo "$" . round(1.6 * $object->{'AMOUNT'}, 2) ?></strong></td>
    </tr>
    <?php
    $y_profits += $object->{'YESTERDAY_PROFITS'};
    $t_profits += $object->{'TOTAL_PROFITS'};
    $goal += 1.6 * $object->{'AMOUNT'};
    $active += $object->{'AMOUNT'};
    $counter = count($result);
    if ($object->{'YESTERDAY_PROFITS_RATE'} != 0) {
        $y_avgp += $object->{'YESTERDAY_PROFITS_RATE'};
    } else {
        $counter = count($result) - 1;
    }
    ?>


<?php endforeach; ?>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<tr class=\"success\">
    <td><strong>OVERALL</strong></td>
    <td><strong><?php echo "$" . sprintf("%01.4f", $active) ?></strong></td>
    <td><strong></strong></td>
    <td><strong><?php echo "$" . $y_profits ?></strong></td>
    <td><strong><?php echo round(($y_avgp / $counter), 4) . "%" ?></strong></td>
    <td><strong><?php echo "$" . $t_profits ?></strong></td>
    <td><strong></strong></td>
    <td><strong><?php echo "$" . round($goal, 2) ?></strong></td>
</tr>
</tbody>
<?php
echo "</table></div>";
?>
<footer class="container-fluid text-center">
    <p>© 2016 Marlive-insider.pl All Rights Reserved.</p>
</footer>
</body>
</html>
