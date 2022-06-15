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

function select_ksiazka() //wyświetla select w formularzu
{ 
    echo "<select style='width: 410px; font-size: 18px; color:green; padding: 4px; display:  block; margin: 0px auto; border: 1px solid #bfc0c2;' name='wybor_ksiazki' title='Nazwa książki'>";


    require_once 'connect.php';
   
    $archiwum_X= new mysqli($hostname, $user, $passwusr, $dbname);
    if($archiwum_X->connect_error) die($archiwum_X->connect_error);
    $archiwum_X->set_charset('utf8');

    $query = "SELECT * FROM ksiazki ORDER BY rok DESC";
    $result= $archiwum_X->query($query);
    if(!$result) die($archiwum_X->error);
    $rows =$result->num_rows;

                                                           
                            
    for($a=0; $a<$rows; $a++)
    {
        $result->data_seek($a);
        echo '<option>'. $result->fetch_assoc()['tytul'] .'</option>';
        $result->data_seek($a);
                                                                
                                                              
    }

    $result->close();
    $archiwum_X->close();                            
    echo "</select>";
}

function randomowy_numerek()
{
    $auth_num_plik= rand(0,20000); 
    echo "<p>Numer autoryzacji:<br/><b>".$auth_num_plik."</b></p>";
    $auth_num_plik+=$numerro;
    return $auth_num_plik;
}




  //PHP dla wyświetlania informacji
            
      
$hostname='mysql.hostinger.pl';
    $user='u869870216_kuba';
    $passwusr='astra17';
    $dbname='u869870216_kuba';
       

    

$nazwa_ksiazki=$_POST['wybor_ksiazki'];
$autor_utworu=$_POST['autor_utw'];
$tytul=$_POST['nazwa_utw'];
$sprawdz_auth=$_POST['Numer_Autoryzacji'];

$nazwa_ksiazki= htmlentities($nazwa_ksiazki, ENT_QUOTES, "UTF-8");
$autor_utworu= htmlentities($autor_utworu, ENT_QUOTES, "UTF-8");
$tytul= htmlentities($tytul, ENT_QUOTES, "UTF-8");


  /*}
   else
    {
        echo "123!";
    }
}
else
{
    echo "Puste pola!";
}
*/

?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Jakub Kaniowski"/>
    <meta name="keywords" content="strona nutowa, nuty, insli, archiwizator nut, strona, internet, stona internetowa, web" />
    <meta name="description" content="Archiwizator Nut" />
    <title>Edytuj utwór | Archiwizator Nut</title>

    <link rel="Shortcut icon" href="ikona.jpg" />
    <link rel="stylesheet" type="text/css" href="Style/style.css" />

    <script type="text/javascript" src="skrypt.js"></script>
    <script type="text/javascript" src="walidator.js"></script>
    <script type="text/javascript" src="jquery.js"></script>
</head>
<body onload="javascript: zegar();">

    <div id="naglowek"><!--Sekcja nagłówka-->
        
        <a href="glowna.php" id="logo">Strona Internetowa</a>    

        <div id="menu">
            <ul>
                <li><a href="glowna.php" class="navi">Strona Główna</a></li>
                <li><a href="dodaj_utw.php" class="navi">Dodaj utwory</a></li>
                <li><a href="dodaj_ks.php" class="navi">Dodaj książki</a></li>
                <li><a href="log.php" class="navi">Odczyt z bazy</a></li>
                <li><a href="informacje.html" class="navi">Informacje</a></li>
                <?php require_once 'connect.php'; uprawnienia();?>
            </ul>

        </div>
    </div><!--Koniec Nagłówka-->


    <div id="zawartosc"><!--Sekcja Głównej Zawartości-->

        <div class="lewy-box"><!--Lewy box po lewej stronie-->
            <h2 class="temat">Edytor utworów..</h2>
            <img src="Obrazy/roland1.jpg" alt="Obraz"/>
            <!--WYSZUKIWARKA DO EDYCJI-->
            <form action="edytuj_utw.php" method="POST">
                <br/><input class="dodaj_utw_form" placeholder="Wyszukaj utwór do edycji" type="search" name="wyszukiwanie" autocomplete="off" required title="&nbsp;&nbsp;Podaj interesujący Cię utwór do wyszukania&nbsp;&nbsp;"/>
            </form>
            <?php
                            require_once 'connect.php';   
                            $archiwum_X= new mysqli($hostname, $user, $passwusr, $dbname);
                            if($archiwum_X->connect_error) die($archiwum_X->connect_error);

                            //WYSZUKIWARKA

                            if((isset($_POST['wyszukiwanie'])))
                            {
                                $fraza=$_POST['wyszukiwanie'];
                                $fraza= htmlentities($fraza, ENT_QUOTES, "UTF-8");
                                $query = "SELECT * FROM utwory_x WHERE nazwa_utworu='$fraza' OR autor='$fraza'";
                                $result= $archiwum_X->query($query);
                                if(!$result) die($archiwum_X->error);
                                $rows =$result->num_rows;
                                
                                $ile_piosenek= $rows;
                                if($ile_piosenek==1)
                                {
                                    echo "<div class='wynik_wyszukiwania' style='display: block;'>";
                                        echo "<div class='bg'></div> 
                                        <div class='kontener'>
                                        <div class='content-okno'>
                                        <div class='content-okno-2'>
                                        <h2 class='temat' style='padding: 5px 0px 5px 0px; background-color: #545042; margin-top:0px; text-align: center;'>Wyniki wyszukiwania</h2>";
                                        echo " <form method='POST' action='edytuj_utw.php'>";
                                    for($b=0; $b<$rows; $b++)
                                    {
                                        
                                            $result->data_seek($b);

                                            echo"<input class='dodaj_utw_form'  type='text' value=".$result->fetch_assoc()['nazwa_utworu']." name='nazwa_utw'  required title='Tytuł piosenki do zapisania'/>";

                                            $result->data_seek($b);
                                            echo"<input class='dodaj_utw_form'  type='text' value=".$result->fetch_assoc()['autor']." name='nazwa_utw'  required title='Tytuł piosenki do zapisania'/>";
                                            
                                            $result->data_seek($b);
                                            echo "<p class='statystyka'  style='font-size: 17px;'>Utwór znajdziesz w: <b style='color: #30badf; float:right;'>".($ksiega=$result->fetch_assoc()['ksiazka'])."</b></p></br>";
                                            select_ksiazka();
                                            $result->data_seek($b); 
                                    
                                            $query_lokalizacja = "SELECT * FROM ksiazki WHERE tytul='$ksiega'";
                                            $result_1= $archiwum_X->query($query_lokalizacja);
                                            if(!$result_1) die($archiwum_X->error);
                                            echo "<p class='statystyka' style='font-size: 17px;'>W miejscu: <b style='color: #30badf; float:right; text-align: center;'>". $result_1->fetch_assoc()['lokalizacja']   ."</b></p></br>";
                                            echo "<form action='edytuj_utw.php' method='post'><input class='button_wyszukaj' type='submit' name='edytuj' value='Edytuj'/></form><hr style='height: 0px; border-top:2px solid #07bf2c;'/></br>";
                                            $result_1->data_seek($a);
                                        
                                        
                                    }
                                    echo "</form>";
                                    echo "</div>
                                    <a href='edytuj_utw.php'><div class='zamknij'>Zamknij</div></a>
                                    </div>
                                    </div>";
                                    echo "</div>";
                                }

                                elseif($ile_piosenek==0)
                                {
                                    echo "<div class='wynik_wyszukiwania' style='display: block;'>";
                                        echo "<div class='bg'></div> 
                                        <div class='kontener'>
                                        <div class='content-okno'>
                                        <div class='content-okno-2'>
                                        <h2 class='temat' style='padding: 5px 0px 5px 0px; background-color: #545042; margin-top:0px; text-align: center; padding: 10px;'>Wyniki wyszukiwania</h2>";
                                        echo "<b style='font-size: 17px; color: red; font-family: czcionka'>Nie znaleziono utworu!</b>";
                                        echo "</div>
                                        <a href='edytuj_utw.php'><div class='zamknij'>Zamknij</div></a>
                                        </div>
                                        </div>";
                                        echo "</div>";
                                    
                                        
                                    
                                }
                                elseif($ile_piosenek>1)
                                    {   
                                        
                                        echo "<div class='wynik_wyszukiwania' style='display: block;'>";
                                        echo "<div class='bg'></div> 
                                        <div class='kontener'>
                                        <div class='content-okno'>
                                        <h2 class='temat' style='padding: 5px 0px 5px 0px; background-color: #545042; margin-top:0px; text-align: center; padding: 10px;'>Wyniki wyszukiwania</h2>
                                        <div class='content-okno-2' style='display:inline-block;'>";
                                        echo " <form method='POST' action='edytuj_utw.php'>";
                                        $a;   
                                        for($b=0; $b<$ile_piosenek; $b++)
                                        {
                                            $result->data_seek($b);
                                            $tytul_ed=$result->fetch_assoc()['nazwa_utworu'];
                                            echo"<input class='dodaj_utw_form'  type='text' value=".printf($tytul_ed)." name='nazwa_utw'  required title='Tytuł piosenki do zapisania'/>";

                                            $result->data_seek($b);
                                            $autor_ed=$result->fetch_assoc()['autor'];
                                            echo"<input class='dodaj_utw_form'  type='text' value=".printf($autor_ed)." name='autor_utw'  required title='Tytuł piosenki do zapisania'/>";
                                            
                                            $result->data_seek($b);
                                            echo "<p class='statystyka'  style='font-size: 17px;'>Utwór znajdziesz w: <b style='color: #30badf; float:right;'>".($ksiega=$result->fetch_assoc()['ksiazka'])."</b></p></br>";
                                            select_ksiazka();
                                            $result->data_seek($b); 
                                    
                                            $query_lokalizacja = "SELECT * FROM ksiazki WHERE tytul='$ksiega'";
                                            $result_1= $archiwum_X->query($query_lokalizacja);
                                            if(!$result_1) die($archiwum_X->error);
                                            echo "<p class='statystyka' style='font-size: 17px;'>W miejscu: <b style='color: #30badf; float:right; text-align: center;'>". $result_1->fetch_assoc()['lokalizacja']   ."</b></p></br>";
                                            echo "<form action='edytuj_utw.php' method='post'><input class='button_wyszukaj' type='submit' name='edytuj' value='Edytuj'/></form><hr style='height: 0px; border-top:2px solid #07bf2c;'/></br>";
                                            $result_1->data_seek($a);

                                           
                                            
                                        } 

                                        echo "</form>";
                                        echo "</div>
                                        <a href='edytuj_utw.php'><div class='zamknij'>Zamknij</div></a>
                                        </div>
                                        </div>";
                                        echo "</div>";                                  
                                   
                                    }
                               
                            }

                            
                            


            ?>
            <h4 class="info_h4">Uwaga! Podczas korzystania z wyszukiwarki, mogą pojawić się błędy!</h4>
            <h4 class="info_h4">Aby wyszukać wybrany utwór, możesz wpisać jego tytuł, lub wykonawcę. Wyszukiwarka sama określi czego ma szukać.</h4>
       



        </div>
      

        <div class="prawy-box"><!--Prawy box po prawej stronie-->
            <h2 class="temat">Narzędzie edycji:</h2>
             
                    <?php //WYŚWIETLACZ UTWORU
                        
                        if((isset($_POST['edytuj'])))
                                        {
                                         

                                            echo $tytul_ed;
                                            echo $autor_ed;
                                        }


                    ?>
            
            
            
            
            
           
        </div>

        <div class="trzeci-box"><!--Dolny box-->

            <h2 class="temat">Popraw dane..</h2>
            <form method="POST" action="edytuj_utw.php"><!--Formularz dodawania utworów-->
             <table class="tabelka_form"><!--Tabela Opłat-->

                    <tr class="tabelka-tr_form">
                   <!--   <td rowspan="4" class="tabelka-td_form_1"><img id="klucz_png" src="klucz-wiolinowy.png" alt="klucz"/></td>-->   
                        <td class="tabelka-td_form_2"><input class="dodaj_utw_form" placeholder="Podaj tytuł" type="text" name="nazwa_utw" autocomplete="off" required title="Tytuł piosenki do zapisania" /></td>
                    </tr>
                    <tr class="tabelka-tr_form">
                        <td class="tabelka-td_form_2"><input class="dodaj_utw_form" placeholder="Podaj Autora" type="text" name="autor_utw" required title="Autor tej piosenki"/></td>
                    </tr>
                    <tr class="tabelka-tr_form">
                        <td class="tabelka-td_form_2"><?php select_ksiazka();?></td>
                    </tr>
                    <tr class="tabelka-tr_form">
                        <td class="tabelka-td_form_2"><input class="dodaj_utw_form" placeholder="Powtórz autoryzację" type="text" maxlength="5" autocomplete="off" name="Numer_Autoryzacji" title="Numer autoryzacji" required /></td>
                    </tr>
                  

             </table>
                 <h4 class="info_h4">Pamiętaj by podawać prawdziwe informacje!</h4> 
                <div class="centra-obiekt"><!--Div centrujący obiekty w jednej linii-->
                    <input class="wyslij_utw_form" id="wysylanie_form" style="background-color: #07bf2c; font-family:czcionka;" onsubmit="galeria();" type="submit" name="dodaj" value="Dodaj" />
                    <div class="wyslij_utw_form_numer"><?php $wartosc= randomowy_numerek($auth_num_plik); $auth=$_POST[$auth_num_plik];?></div>
                    <input class="wyslij_utw_form" style="background-color: #f82b2b; font-family:czcionka;" type="reset" name="reset" value="Wyczyść"/>
                </div>
             </form><!--Koniec Formularza dodawania utworów-->
          

            </div>


    </div><!--Koniec Sekcji Głównej Zawartości-->

    <div id="stopka"><!--Sekcja Stopki-->
        <?php 
            require_once 'connect.php';
            
            
           if(isset($_SESSION["zalogowany"]))
                    {
                        echo "<small style='font-weight:500; color:#07bf2c;   margin-right: 10px;'>Zalogowano jako: <a href='profil.php' alt='PROFIL' id='link_profil'><b style='color: #30badf;'>".$_SESSION["user"]." ".$_SESSION["user_nazwisko"]."</b></a></small><a class='wyloguj'' href='wyloguj.php' alt='Logout'>Wyloguj</a>";
                    }
        ?>
        <small style="color: white; font-family: Calibri; font-size: 15px;">Copyright &copy; Jakub Kaniowski 2016.  Potato Corporation&reg;</small>

        <?php //PHP DODAWANIE UTWORÓW
       if(isset($_POST['dodaj']))
                {
                       
  
                    require_once 'dodaj_utw.php';
                    
                    $archiwum_X= new mysqli($hostname, $user, $passwusr, $dbname);
                    if($archiwum_X->connect_error) die($archiwum_X->connect_error);

                    $query = "INSERT INTO utwory_x VALUES($wartosc,'$tytul','$autor_utworu','$nazwa_ksiazki','$sprawdz_auth')";
                    $result= $archiwum_X->query($query);
                    
                    if(!$result) die("<p style='color:orange; '>>&nbsp;&nbsp;!&nbsp;&nbsp; Ups.. Wystąpił błąd: &nbsp;<i>".$archiwum_X->error."</i>&nbsp;<</p>");
                    
                  
                     
                    
                    }
                    else
                    {
                        
                    }
            
        ?>    



    </div><!--Koniec Sekcji Stopki-->
    

    <!--Okno-->
    <div class="alert-okno">
        <div class="bg"></div>
        <div class="kontener">

            
            <div class="content-okno">
                <div class="content-okno-2">
                    <h2 class="content-header">Ważna informacja!</h2>
                    <div>
                        <p>Ta da. <br /><br /> Pozdrawiam Administrator</p>
                    </div>
                </div>
                <div class="zamknij">Zamknij</div>

            </div>
            

        </div>
     </div>
                
</body>
</html>