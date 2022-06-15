<!DOCTYPE html>
<?php 
      session_start(); 
      
       if(isset($_SESSION["zalogowany"]))
                    {
                       
                    }
                    else
                    {
                        $_SESSION['niezalogowany']= "<img class='alert_ico' src='Ikonki/error.png' alt='[Error]'/><p style='font-weight:600; color:red; text-align: center; display: inline-block;'>Błąd! Jesteś niezalogowany!</p>";
                        header("Location: index.php");
                    }   
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Jakub Kaniowski"/>
    <meta name="keywords" content="strona nutowa, nuty, insli, archiwizator nut, strona, internet, stona internetowa, web" />
    <meta name="description" content="Archiwizator Nut" />
    <title>Przetwarzanie..</title>

    <link rel="Shortcut icon" href="ikona.jpg" />
    <link rel="stylesheet" type="text/css" href="Style/logowanie.css" />
    
</head>
<body>

  
        <div id="naglowek"><!--Sekcja nagłówka-->
        
        <a href="index.php" id="logo">Strona Internetowa</a>    

        <div id="menu">
           <h4 class="info_h4">Przetwarzanie danych</h4>
        </div>
    </div><!--Koniec Nagłówka-->

    <div id="zawartosc"><!--Sekcja Głównej Zawartości-->
        <?php

            require_once("connect.php");
            $login=$_POST['login'];
            $haslo=$_POST['haslo'];

            $login= htmlentities($login, ENT_QUOTES, "UTF-8");
            $haslo= htmlentities($haslo, ENT_QUOTES, "UTF-8");
            
            $archiwum_X= new mysqli($hostname, $user, $passwusr, $dbname);
                    if($archiwum_X->connect_error) die($archiwum_X->connect_error);
                    $archiwum_X->set_charset('utf8');
                    $query = "SELECT * FROM uzytkownicy WHERE login='$login' AND haslo='$haslo';";
                    $result= $archiwum_X->query($query);
                    $ilu_userow=$result->num_rows;
                    if($ilu_userow==1)
                    {
                        $_SESSION['zalogowany']=TRUE;

                        $wiersz= $result->fetch_assoc();
                        echo "<p style='font-weight:600; color:green; text-align: center;'>Pomyślnie zalogowano jako: <b style='color: #30badf;'>".$wiersz['imie']." ".$wiersz['nazwisko']."</b></br>Proszę czekać..</p>";
                        $_SESSION["user"]= $wiersz['imie'];
                        $_SESSION["user_nazwisko"]= $wiersz['nazwisko'];
                        $_SESSION["dostep"]= $wiersz['uprawnienia'];
                        unset($_SESSION['blad']);
                        $result-> close();
                        header("Location: glowna.php");
                    }
                    else
                    {
                       $_SESSION['blad']= "<img class='alert_ico' src='Ikonki/error.png' alt='[Error]'/><p style='font-weight:600; color:red; text-align: center; display: inline-block;'>Błąd! Zły login bądź hasło!</p>";
                        
                       header("Location: index.php");
                    }
                    if(!$result) die("<img class='alert_ico' src='Ikonki/error.png' alt='[Error]'/><p style='color:orange; text-align: center; display: inline-block;'>>&nbsp;!&nbsp;&nbsp; Ups.. Wystąpił błąd. Skontaktuj się z administratorem&nbsp;&nbsp; <</p>");
                    
                    

            $result-> close();

            $archiwum_X->close();

        ?>
        

    </div><!--Koniec Sekcji Głównej Zawartości-->

    <div id="stopka"><!--Sekcja Stopki-->
        <?php
            if(isset($_SESSION["zalogowany"]))
                    {
                        echo "<small style='font-weight:500; color:#07bf2c;   margin-right: 15px;'>Zalogowano jako: <b style='color: #30badf;'>".$_SESSION["user"]." ".$_SESSION["user_nazwisko"]."</b></small><a class='wyloguj'' href='wyloguj.php' alt='Logout'>Wyloguj</a>";
                    }
                   
                  
        ?>
        <small style="color: white; font-family: Calibri; font-size: 15px;">Copyright &copy; Jakub Kaniowski 2016.  Potato Corporation&reg;</small>
    </div><!--Koniec Sekcji Stopki-->
    

</body>
</html>