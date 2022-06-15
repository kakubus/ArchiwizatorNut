<!DOCTYPE html>
<?php 
      session_start(); 
      
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
    <title>Dodaj termin | Archiwizator Nut</title>

    <link rel="Shortcut icon" href="ikona.jpg" />
    <link rel="stylesheet" type="text/css" href="Style/style.css" />

    
</head>
<body>

    <div id="naglowek"><!--Sekcja nagłówka-->
        
        <a href="glowna.php" id="logo">Strona Internetowa</a>    

        <div id="menu">
            <ul>
                <li><a href="glowna.php" class="navi" >Strona Główna</a></li>
                <li><a href="dodaj_utw.php" class="navi">Dodaj utwory</a></li>
                 <li><a href="dodaj_ks.php" class="navi">Dodaj książki</a></li>
                <li><a href="log.php" class="navi">Odczyt z bazy</a></li>
                <li><a href="informacje.html" class="navi">Informacje</a></li>
                <?php require_once 'connect.php'; uprawnienia();?>
            </ul>

        </div>
    </div><!--Koniec Nagłówka-->

    <div id="zawartosc" style="display:  inline-block; text-align: center"><!--Sekcja Głównej Zawartości-->

        

        <div class="trzeci-box" style="display:inline-block; text-align: center"><!--Dolny box taki sam jak w ofertach-->

            <h2 class="temat">Nowa próba..</h2>

            <form method="POST" action="nowa_proba.php"><!--Formularz dodawania utworów-->
             <table class="tabelka_form" style="text-align: center"><!--Tabela Opłat-->
            
                    <tr class="tabelka-tr_form">
                   <!--   <td rowspan="4" class="tabelka-td_form_1"><img id="klucz_png" src="klucz-wiolinowy.png" alt="klucz"/></td>-->  
                        <td class="tabelka-td_form_2"><input class="dodaj_utw_form" autocomplete="off" placeholder="Data" type="date" name="data" required title="Termin najbliższej próby."/></td>
                    </tr>
                    <tr class="tabelka-tr_form">
                        <td class="tabelka-td_form_2"><input class="dodaj_utw_form" placeholder="Godzina" type="time"  name="godzina"  title="Godzina" required/></td>
                    </tr>
                    <tr class="tabelka-tr_form">
                        <td class="tabelka-td_form_2">
                            <select name="lokalizacja" class="dodaj_utw_form" title="Gdzie?" style='width: 410px; font-size: 18px; color:green; padding: 4px; display:  block; margin: 0px auto; border: 1px solid #bfc0c2;'>
                                <option>Gminny Ośrodek Kultury w Sarnowie</option>
                                <option>Gminny Ośrodek Kultury w XXX</option>
                                <option>Gminny Ośrodek Kultury w YYY</option>
                            </select></td>
                    </tr>
                    
                    
                    
                  

             </table>
                 <h4 class="info_h4">Pamiętaj by podawać prawdziwe informacje!</h4> 
                <div class="centra-obiekt" style="text-align: center;"><!--Div centrujący obiekty w jednej linii-->
                    <input class="wyslij_utw_form" id="wysylanie_form" style="background-color: #07bf2c; font-family:czcionka;" type="submit" name="dodaj" value="Dodaj"/>
                   
                    <input class="wyslij_utw_form" style="background-color: #f82b2b; font-family:czcionka;" type="reset" name="reset" value="Wyczyść"/>
                </div>
             </form><!--Koniec Formularza dodawania utworów-->
            
            
            
	
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