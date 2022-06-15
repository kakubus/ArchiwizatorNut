<!DOCTYPE html>
<?php 
      session_start(); 
      $uprawnienia=$_SESSION['dostep'];
      if($uprawnienia >= 3)
      {
          header("Location: glowna.php");
      }
      
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
    <meta name="keywords" content="archiwizator nut, nuty, archiwum, archiwizacja, nut, strona, internet, stona internetowa, web" />
    <meta name="description" content="Archiwizator Nut, system magazynowania nut, i zarządzania zbiorami." />
    <title>Archiwizator Nut</title>

    <link rel="Shortcut icon" href="ikona.jpg" />
    <link rel="stylesheet" type="text/css" href="Style/style.css" />
    <link rel="stylesheet" type="text/css" href="Style/logowanie.css" />
</head>
<body>

    <div id="naglowek"><!--Sekcja nagłówka-->
        
        <a href="glowna.php" id="logo">Strona Internetowa</a>    

        <div id="menu">
            <h4 class="info_h4">Skontaktuj się z administratorem</h4>
        </div>
    </div><!--Koniec Nagłówka-->

    <div id="zawartosc"><!--Sekcja Głównej Zawartości-->
        <div style="width: 100%; display: block; margin: 0px auto; width: 500px; padding: 4px; border: 1px solid #30badf; background-color: #5fffb9; text-align: center;">
        <?php
           echo "<img class='alert_ico' src='Ikonki/error.png' alt='[Error]'/><p style='font-weight:600; color:red; text-align: center; display: inline-block;'>Brak uprawnień do tej czynności <br/> Odmowa dostępu.</p><img class='alert_ico' src='Ikonki/error.png' style='float:right;' alt='[Error]'/><br/>";
           echo "<a href='javascript:history.go(-1);' class='przekierowanie' alt='Poprzednia strona'>Powrót do poprzedniej strony..</a>"
        ?>
        </div>  
       

        


    </div><!--Koniec Sekcji Głównej Zawartości-->

    <div id="stopka"><!--Sekcja Stopki-->

         <?php 
           if(isset($_SESSION["zalogowany"]))
                    {
                        echo "<small style='font-weight:500; color:#07bf2c;   margin-right: 10px;'>Zalogowano jako: <a href='profil.php' alt='PROFIL' id='link_profil'><b style='color: #30badf;'>".$_SESSION["user"]." ".$_SESSION["user_nazwisko"]."</b></a></small><a class='wyloguj'' href='wyloguj.php' alt='Logout'>Wyloguj</a>";
                    }
        ?>
        <small style="color: white; font-family: Calibri; font-size: 15px;">Copyright &copy; Jakub Kaniowski 2016.  Potato Corporation&reg; &nbsp; Wersja: 1.0</small>
    </div><!--Koniec Sekcji Stopki-->
    

</body>
</html>