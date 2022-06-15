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
    global $hostname, $user, $passwusr, $dbname;
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
    <title>Dodaj utwór | Archiwizator Nut</title>

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
                <li><a href="dodaj_utw.php" class="navi" style="color: #07bf2c; border-bottom: 1px solid red; ">Dodaj utwory</a></li>
                <li><a href="dodaj_ks.php" class="navi">Dodaj książki</a></li>
                <li><a href="log.php" class="navi">Odczyt z bazy</a></li>
                <li><a href="informacje.html" class="navi">Informacje</a></li>
                <?php require_once 'connect.php'; uprawnienia();?>
            </ul>

        </div>
    </div><!--Koniec Nagłówka-->


    <div id="zawartosc"><!--Sekcja Głównej Zawartości-->

        <div class="lewy-box"><!--Lewy box po lewej stronie-->
            <h2 class="temat">Kreator dodawania utworów!</h2>
            <img src="Obrazy/roland1.jpg" alt="Obraz"/>
        </div>
      

        <div class="prawy-box"><!--Prawy box po prawej stronie-->
            <h2 class="temat">Narzędzie tworzenia utworów:</h2>
             <form method="POST" action="dodaj_utw.php"><!--Formularz dodawania utworów-->
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
                    <tr class="tabelka-tr_form"><!--Zespol-->
                        <td class="tabelka-td_form_2">Zespół:        
                        <input id="odpowiedz_1" type="radio" name="zespol"  accesskey="T" value="1">  
                        <label for="odpowiedz_1">Tak</label>  
                        <input id="odpowiedz_2" type="radio" name="zespol" accesskey="N" value="0" checked="checked">  
                        <label for="odpowiedz_2">Nie</label> 
                       </td>
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

        <div class="trzeci-box"><!--Dolny box-->

            <h2 class="temat">Informacje- Kreator dodawania utworów..</h2>

          

            <p>Phasellus vestibulum. Etiam tempor venenatis vitae, egestas aliquam, risus. Aliquam eget imperdiet vel, metus. Curabitur faucibus. Sed eget felis. Fusce iaculis, turpis risus at nibh. Fusce posuere cubilia Curae, Cras ornare. Nam laoreet nisl pede, luctus et lorem. Pellentesque eu pede sit amet tempus facilisis, wisi diam eros, rhoncus eu, luctus quis, velit. Suspendisse eu odio. Suspendisse a&nbsp;dolor lacus, elementum vitae, velit. Donec gravida feugiat venenatis, elit viverra justo. Donec auctor vitae, ultricies vitae, vulputate quam. Aliquam adipiscing laoreet, tortor pede nunc tempus id, tortor. Cum sociis natoque penatibus et ultrices velit, rhoncus placerat at, porttitor magna. Aliquam posuere orci. Nunc vitae massa non risus. Aliquam dolor sit amet dolor. Nullam accumsan. Proin scelerisque a, convallis tellus. In hac habitasse platea dictumst. Aenean ut vehicula libero ante, porta sed, ultrices dui. Integer neque at ipsum primis in orci eget velit lectus pharetra lobortis velit ornare egestas sit amet sapien leo sit amet, nonummy faucibus orci molestie placerat, egestas quis, rhoncus gravida. Pellentesque scelerisque porttitor a, dolor. Integer adipiscing non, neque. Vestibulum a&nbsp;metus. Curabitur vel turpis. Cras tempus ipsum.</p>
            <p>Phasellus vestibulum. Etiam tempor venenatis vitae, egestas aliquam, risus. Sed eget felis. Fusce iaculis, turpis risus at nibh. Fusce posuere cubilia Curae, Cras ornare. Nam laoreet nisl pede, luctus et lorem. Pellentesque eu pede sit amet tempus facilisis, wisi diam eros, rhoncus eu, luctus quis, velit. Suspendisse eu odio. Suspendisse a&nbsp;dolor lacus, elementum vitae, velit. Donec gravida feugiat venenatis, elit viverra justo. Donec auctor vitae, ultricies vitae, vulputate quam. Aliquam adipiscing laoreet, tortor pede nunc tempus id, tortor. Cum sociis natoque penatibus et ultrices velit, rhoncus placerat at, porttitor magna. Aliquam posuere orci. Nunc vitae massa non risus. Aliquam dolor sit amet dolor. Nullam accumsan. Proin scelerisque a, convallis tellus. In hac habitasse platea dictumst. Aenean ut vehicula libero ante, porta sed, ultrices dui. Integer neque at ipsum primis in orci eget velit lectus pharetra lobortis velit ornare egestas sit amet sapien leo sit amet, nonummy faucibus orci molestie placerat, egestas quis, rhoncus gravida. Pellentesque scelerisque porttitor a, dolor. Integer adipiscing non, neque. Vestibulum a&nbsp;metus. Curabitur vel turpis. Cras tempus ipsum.</p>
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
                    $archiwum_X->set_charset('utf8');
                    $query = "INSERT INTO utwory_x VALUES($wartosc,'$tytul','$autor_utworu','$nazwa_ksiazki', '0','$sprawdz_auth')";
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