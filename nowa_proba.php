<?php
    session_start(); 

    require_once "connect.php";
    $przyzwolenie=$_SESSION['dostep'];

        switch($przyzwolenie)
        {
            case 0:
            header("Location: error.php");
            break;

            case 1:
            header("Location: error.php");
            break;

            
        }

$data=$_POST['data'];
$godzina=$_POST['godzina'];
$gdzie=$_POST['lokalizacja'];
$kto="Nikt";

$archiwum_X= new mysqli($hostname, $user, $passwusr, $dbname);
                    if($archiwum_X->connect_error) die($archiwum_X->connect_error);
                    $archiwum_X->set_charset('utf8');
                    $query = "INSERT INTO proba VALUES('$data','$godzina','$gdzie','$kto')";
                    $result= $archiwum_X->query($query);
                    
                    if(!$result) die("<p style='color:orange; '>>&nbsp;&nbsp;!&nbsp;&nbsp; Ups.. Wystąpił błąd: &nbsp;<i>".$archiwum_X->error."</i>&nbsp;<</p>");
                    $archiwum_X-> close();   
    header("Location: glowna.php");


?>

