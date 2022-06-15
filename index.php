<!DOCTYPE html>
<?php 
      session_start();    
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Jakub Kaniowski"/>
    <meta name="keywords" content="strona nutowa, nuty, insli, archiwizator nut, strona, internet, stona internetowa, web" />
    <meta name="description" content="Archiwizator Nut" />
    <title>Zaloguj | ARCHIWIZATOR NUT 1.0</title>

    <link rel="Shortcut icon" href="ikona.jpg" />
    <link rel="stylesheet" type="text/css" href="Style/logowanie.css" />
    
</head>
<body>

    <div id="naglowek"><!--Sekcja nagłówka-->
        
        <a href="index.php" id="logo">Strona Internetowa</a>    

        <div id="menu">
          
           <h4 class="info_h4">Prosimy o poprawne zalogowanie się</h4>
        </div>
    </div><!--Koniec Nagłówka-->

    <div id="zawartosc"><!--Sekcja Głównej Zawartości-->
        <div class="profil">
        <div class="zaloguj">
         <form action="zaloguj.php" method="POST">
                <div id="lewa_log">
                    <input class="dodaj_utw_form" placeholder="Użytkownik" type="text" maxlength="20" name="login" title="Nazwa użytkownika" required/>
                    <input class="dodaj_utw_form" placeholder="Hasło" type="password" maxlength="15" name="haslo" title="Hasło" required/>
                </div>
                <div id="prawa_log">
                     <input class="wyslij_utw_form_reset" type="reset" name="reset" value="Wyczyść"/>
                     <input class="wyslij_utw_form" type="submit" value="Zaloguj"/>
                </div>
            </form>
            </div>
            <div class="centra-obiekt">
         <?php 
            
                 if(isset($_SESSION["zalogowany"]))
                    {
                        header("Location: glowna.php");
                    }
                 

                if(isset($_SESSION['blad']))
                {
                    echo "<br/>".$_SESSION['blad'];
                }
                 if(isset($_SESSION['niezalogowany']))
                {
                    echo "<br/>".$_SESSION['niezalogowany'];
                }
           
           ?>
            </div>
            </div>
    </div><!--Koniec Sekcji Głównej Zawartości-->

    <div id="stopka"><!--Sekcja Stopki-->
        <small style="color: white; font-family: Calibri; font-size: 15px;">Copyright &copy; Jakub Kaniowski 2016.  Potato Corporation&reg;</small>
    </div><!--Koniec Sekcji Stopki-->
    

</body>
</html>