<?php

    session_start();

/*
    if (isset($_POST['email']))
    {
        //Udana walidacja? Załóżmy , że tak!
        $is_OK=true;

        $login = $_POST['login'];

        if ((strlen($login)<3)||(strlen($login))>20)
        {
            $is_OK=false;
            $_SESSION['e_login']="Login has to be 3 to 20 letters!";
        }

        if (ctype_alnum($nick)==false)
        {
            $wszystko_OK=false;
            $_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
        }

        // Sprawdź poprawność adresu email
        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
        {
            $wszystko_OK=false;
            $_SESSION['e_email']="Podaj poprawny adres e-mail!";
        }

        //Sprawdź poprawność hasła
        $haslo1 = $_POST['haslo1'];
        $haslo2 = $_POST['haslo2'];

        if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
        {
            $wszystko_OK=false;
            $_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
        }

        if ($haslo1!=$haslo2)
        {
            $wszystko_OK=false;
            $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
        }

        $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

        //Czy zaakceptowano regulamin?
        if (!isset($_POST['regulamin']))
        {
            $wszystko_OK=false;
            $_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
        }

        //Bot or not? Oto jest pytanie!
        $sekret = "PODAJ WŁASNY SEKRET!";

        $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

        $odpowiedz = json_decode($sprawdz);

        if ($odpowiedz->success==false)
        {
            $wszystko_OK=false;
            $_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
        }

        //Zapamiętaj wprowadzone dane
        $_SESSION['fr_nick'] = $nick;
        $_SESSION['fr_email'] = $email;
        $_SESSION['fr_haslo1'] = $haslo1;
        $_SESSION['fr_haslo2'] = $haslo2;
        if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;

        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try
        {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if ($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                //Czy email już istnieje?
                $rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");

                if (!$rezultat) throw new Exception($polaczenie->error);

                $ile_takich_maili = $rezultat->num_rows;
                if($ile_takich_maili>0)
                {
                    $wszystko_OK=false;
                    $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
                }

                //Czy nick jest już zarezerwowany?
                $rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");

                if (!$rezultat) throw new Exception($polaczenie->error);

                $ile_takich_nickow = $rezultat->num_rows;
                if($ile_takich_nickow>0)
                {
                    $wszystko_OK=false;
                    $_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
                }

                if ($wszystko_OK==true)
                {
                    //Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy

                    if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo_hash', '$email', 100, 100, 100, 14)"))
                    {
                        $_SESSION['udanarejestracja']=true;
                        header('Location: witamy.php');
                    }
                    else
                    {
                        throw new Exception($polaczenie->error);
                    }

                }

                $polaczenie->close();
            }

        }
        catch(Exception $e)
        {
            echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
            echo '<br />Informacja developerska: '.$e;
        }
    }
*/
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="js/validateform.js"></script>
</head>
<title>MagLinkere.pl - Account Creation</title>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
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
            <li><a href="panel.php">Statistics</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
        </ul>
    </div>
</nav>
<div class="container">

    <form name="validForm" class="form-signin" method="post" onsubmit="return validateform()">
        <h2 class="form-signin-heading">Please fill the form!</h2>
        <label for="inputLogin" class="sr-only">Login</label>
        <input type="text" name="login" class="form-control" placeholder="Login"><span id="nameErrMsg" class="error"></span>
        <?php /*if(isset($_SESSION['e_login']))
        {
            echo '<div class="error">'.$_SESSION['e_login'].'</div>';
            unset($_SESSION['e_login']);
        }*/
        ?>
        <label for="inputPassword1" class="sr-only">Your password</label>
        <input type="password" name="pass1" class="form-control" placeholder="Your password">
        <label for="inputPassword2" class="sr-only">Confirm password</label>
        <input type="password" name="pass2" class="form-control" placeholder="Confirm password">
        <label for="inputEmail" class="sr-only">E-mail</label>
        <input type="text" name="email" class="form-control" placeholder="E-mail">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="reg" /> Agree terms.
            </label>
        </div>
        <div class="g-recaptcha" data-sitekey="6Lfc7BYTAAAAADSFJGrYUFBQH2pgdYblKQK8m_5k"></div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <?php

        if (isset($_SESSION['error'])) echo "<p style='text-align: center'>" . $_SESSION['error'] . "</p>";

        ?>
    </form>

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
</body>
</html>
