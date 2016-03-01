<?php
/*
$to      = 'wojtas.neo@gmail.com';
$subject = 'the subject';

$message = $_POST['message'];

$headers = 'From: hackedbyr@neo.com' . "\r\n" .
    'Reply-To: hackedbyr@neo.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

//var_dump($message);

mail($to, $subject, $message, $headers);

echo 'Message sent!';*/

session_start();

if (isset($_POST['email']))
{
    require_once "dbconnect.php";
    if (db_connect()) {
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $msg = $_POST['message'];
        $submit_date = date("Y-m-d H:i:s");

        if (db_query("INSERT INTO messages VALUES (NULL,'$submit_date' ,'$email', '$subject', '$msg', 1)")) {
            $_SESSION['info'] = 'You message has been sent! Thank you.';
            header('Location:contact.php');
        } else {
            $error = db_error();
            echo $error;
        }
    }
}
?>