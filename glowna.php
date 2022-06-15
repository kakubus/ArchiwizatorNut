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
    <title>Archiwizator Nut</title>

    <link rel="Shortcut icon" href="ikona.jpg" />
    <link rel="stylesheet" type="text/css" href="Style/style.css" />
    <link rel="stylesheet" type="text/css" href="Style/profil.css" />
    
</head>
<body>

    <div id="naglowek"><!--Sekcja nagłówka-->
        
        <a href="glowna.php" id="logo">Strona Internetowa</a>    

        <div id="menu">
            <ul>
                <li><a href="glowna.php" class="navi" style="color: #07bf2c; border-bottom: 1px solid red; ">Strona Główna</a></li>
                <li><a href="dodaj_utw.php" class="navi">Dodaj utwory</a></li>
                 <li><a href="dodaj_ks.php" class="navi">Dodaj książki</a></li>
                <li><a href="log.php" class="navi">Odczyt z bazy</a></li>
                <li><a href="informacje.html" class="navi">Informacje</a></li>
                <?php require_once 'connect.php';
        $przyzwolenie=$_SESSION['dostep'];
        if($przyzwolenie >=3)
        {
            echo "<li><a href='dodaj_probe.php' class='navi'>Dodaj termin</a></li>";
        }
  ?>
            </ul>

        </div>
    </div><!--Koniec Nagłówka-->

    <div id="zawartosc"><!--Sekcja Głównej Zawartości-->

        <div class="lewy-box"><!--Lewy box taki sam jak w ofertach-->
            <h2 class="temat">Witaj w archiwizatorze nut!</h2>
            <p style="text-align: justify;"> Archiwizator Nut 1.2 to projekt realizowany w celach samorozwoju. Oferuje przechowywanie, katalogowanie, i poszukiwanie zbioru utworów.<br/><br/>
			Krótki opis podstron: <br>
			<b>Dodaj utwory</b>- podstrona odpowiedzialana za wpisywanie utworów do bazy danych (wymagane uprawnienia). <br>
			<b>Dodaj książki</b> - podstrona odpowiedzialna za tworzenie nowych książek w bazie danych (wymagane uprawnienia). <br>
			<b>Odczyt z bazy</b> - podstrona wyświetlająca całą bazę utworów. Oferuje również szybkie wyszukiwanie oraz podglądanie spisów treści danych książek. <br>
			<b>Informacje</b> - podstrona zawierająca informacje nt. tego serwisu. <br> <br>
			Mauris eros sem ac lacus non elit arcu, dapibus vitae, pellentesque quis, pellentesque sed, suscipit sit amet lorem. Morbi urna elit, dictum eu, faucibus orci ac nunc hendrerit wisi. Integer non leo. Aenean tincidunt tellus non urna eget velit. Mauris viverra est eu wisi.
			</p>
            
        </div>

        <div class="prawy-box"><!--Prawy box taki sam jak w ofertach-->
            <h2 class="temat">Obrazek</h2>
            <img src="Obrazy/mikser.jpg" alt="Logo projektu"/>
        </div>

        <div class="trzeci-box"><!--Dolny box taki sam jak w ofertach-->

            <h2 class="temat">Kiedy próba?</h2>
            <?php
                $baza= new mysqli($hostname, $user, $passwusr, $dbname);
        if($baza->connect_error) die($baza->connect_error);
        $baza->set_charset('utf8');
        $query3 = "SELECT * FROM proba ORDER BY data DESC LIMIT 1";
        $result= $baza->query($query3);
        $poprzednio= $result->fetch_assoc();

        $data=$poprzednio['data'];
        $godzina=$poprzednio['godzina'];

        $gdzie=$poprzednio['gdzie'];  
        
         echo"<p class='kiedy_proba'>Następna próba: ".$data."</p>";
	     echo"<p class='kiedy_proba_godzina'>Godzina: ".$godzina."</p>";
	     echo"<p class='kiedy_proba_gdzie'>".$gdzie."</p>";

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
        <small style="color: white; font-family: Calibri; font-size: 15px; text-align: left; ">Copyright &copy; Jakub Kaniowski 2016.  Potato Corporation&reg;</small>
    </div><!--Koniec Sekcji Stopki-->
    

</body>
</html>