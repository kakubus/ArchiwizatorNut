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
    <link rel="stylesheet" type="text/css" href="Style/profil.css" />
</head>
<body>

    <div id="naglowek"><!--Sekcja nagłówka-->
        
        <a href="glowna.php" id="logo">Strona Internetowa</a>    

        <div id="menu">
            <ul>
                <li><a href="glowna.php" class="navi">Strona Główna</a></li>
                <li><a href="dodaj_utw.php" class="navi">Dodaj utwory</a></li>
                <li><a href="dodaj_ks.php" class="navi">Dodaj książki</a></li>
                <li><a href="log.php" class="navi">Odczyt z bazy</a></li>
                <li><a href="informacje.html" class="navi">Informacje</a></li>
                <?php/* require_once 'connect.php'; uprawnienia();*/?>
            </ul>
  
        </div>
    </div><!--Koniec Nagłówka-->


    <div id="zawartosc"><!--Sekcja Głównej Zawartości-->
    <div class='profil'><!--Box profilowy, koniec w php-->
    <h4 class="info_h4">Twój profil..</h4> 
         <div class="profilowe_box">
                
                <img src="profil.png" alt="Twoje zdjęcie profilowe" class="zdjecie_profilowe"/>
                
                
                <?php
            
                            

                            require_once 'connect.php';
                            $archiwum_X= new mysqli($hostname, $user, $passwusr, $dbname);
                            if($archiwum_X->connect_error) die($archiwum_X->connect_error);
                            $archiwum_X->set_charset('utf8');
                            $twoje_imie=$_SESSION['user'];
                            $twoje_nazwisko=$_SESSION['user_nazwisko'];
                            $query = "SELECT * FROM uzytkownicy WHERE imie='$twoje_imie' AND nazwisko='$twoje_nazwisko'";
                            $result= $archiwum_X->query($query);
                            if(!$result) die($archiwum_X->error);
                            $rows =$result->num_rows;

                            echo "<h3 class='whoami'>".$twoje_imie." ".$twoje_nazwisko."</h3>";
                              
                            
                            
                                    echo "<p class='profil_dane''>&nbsp;Login: <div class='prezentacja_danych'>".$result->fetch_assoc()['login']  ."</div></p>";
                                    $result->data_seek($b);
                                    echo "<p class='profil_dane''>&nbsp;Email: <div class='prezentacja_danych'>". $result->fetch_assoc()['email']   ."</div></p>";
                                    $result->data_seek($b);
                                    echo "<p class='profil_dane''>&nbsp;Skąd: <div class='prezentacja_danych'>". $result->fetch_assoc()['skad']   ."</div></p>";
                                    $result->data_seek($b);
                                    echo "<p class='profil_dane''>&nbsp;Hobby: <div class='prezentacja_danych'>". $result->fetch_assoc()['hobby']   ."</div></p>";
                                    $result->data_seek($b);
                                    echo "<p class='profil_dane''>&nbsp;O sobie: <div class='prezentacja_danych_osobie'>". $result->fetch_assoc()['o_sobie']   ."</div></p>";
                            
                            echo "<p class='profil_dane''>&nbsp;Uprawnienia: "."<div class='prezentacja_danych_osobie' style='font-style: normal;'>";
                            pokaz_uprawnienia();
                            echo "</div></p>";
                            echo "</div>";
                        

                            $result->close();
                            $archiwum_X->close();                            
                            
                            

            ?>
                
            </div>
       

    </div><!--Koniec Sekcji Głównej Zawartości-->
    </div>
    <div id="stopka"><!--Sekcja Stopki-->
        <?php 
           if(isset($_SESSION["zalogowany"]))
                    {
                        echo "<small style='font-weight:500; color:#07bf2c;   margin-right: 10px;'>Zalogowano jako: <a href='profil.php' alt='PROFIL' id='link_profil'><b style='color: #30badf;'>".$_SESSION["user"]." ".$_SESSION["user_nazwisko"]."</b></a></small><a class='wyloguj'' href='wyloguj.php' alt='Logout'>Wyloguj</a>";
                    }
        ?>
        <small style="color: white; font-family: Calibri; font-size: 15px;">Copyright &copy; Jakub Kaniowski 2016.  Potato Corporation&reg;</small>
    </div><!--Koniec Sekcji Stopki-->
    

</body>
</html>