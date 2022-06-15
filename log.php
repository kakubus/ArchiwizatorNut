<!DOCTYPE html>
<?php 
 
      session_start(); 
      header('Content-Type: text/html; charset=utf8mb4_polish_ci');
      $przyzwolenie=$_SESSION["dostep"];
      if($przyzwolenie==0)
      {
          header('Location: error.php');
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
    <title>Baza utworów | Archiwizator Nut</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <link rel="Shortcut icon" href="ikona.jpg" />
    <link rel="stylesheet" type="text/css" href="Style/style.css" />
</head>
<body>

    <div id="naglowek"><!--Sekcja nagłówka-->
        
        <a href="glowna.php" id="logo">Strona Internetowa</a>    

        <div id="menu">
            <ul>
                <li><a href="glowna.php" class="navi">Strona Główna</a></li>
                <li><a href="dodaj_utw.php" class="navi">Dodaj utwory</a></li>
                <li><a href="dodaj_ks.php" class="navi">Dodaj książki</a></li>
                <li><a href="log.php" class="navi" style="color: #07bf2c; border-bottom: 1px solid red;">Odczyt z bazy</a></li>
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

        <div class="lewy-box"><!--Lewy box po lewej stronie-->
            <h2 class="temat">Podgląd bazy danych</h2>
            <img src="Obrazy/yamaha.jpg" alt="Obraz"/><br/>
            <form action="log.php" method="POST">
                <br/><input class="dodaj_utw_form" placeholder="Wyszukaj utwór" type="search" name="wyszukiwanie" autocomplete="off" required title="&nbsp;&nbsp;Podaj interesujący Cię utwór do wyszukania&nbsp;&nbsp;"/>
            </form>
            <?php
                            require_once 'connect.php';   
                            $archiwum_X= new mysqli($hostname, $user, $passwusr, $dbname);
                            
                            $archiwum_X->set_charset('utf8');
                            
                            //$archiwum_X = mb_convert_encoding($archiwum_X, 'UTF-8', mb_detect_encoding( $archiwum_X));
                          
                            if($archiwum_X->connect_error) die($archiwum_X->connect_error);
                         
                            //WYSZUKIWARKA

                            if((isset($_POST['wyszukiwanie'])))
                            {
                                $fraza=$_POST['wyszukiwanie'];
                                $fraza= htmlentities($fraza, ENT_QUOTES, "UTF-8");
                                //$archiwum_X->set_charset("utf8");
                                $query = "SELECT * FROM utwory_x WHERE nazwa_utworu='$fraza' OR autor='$fraza' OR nazwa_utworu LIKE '$fraza%'  OR nazwa_utworu LIKE '%$fraza' OR autor LIKE '$fraza%' OR autor LIKE '%$fraza' ";
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
                                    for($b=0; $b<$rows; $b++)
                                    {
                                        
                                            $result->data_seek($b);
                                            echo "<p class='statystyka' style='font-size: 17px;'>Tytuł: <b style='color: #30badf; float:right;'>". $result->fetch_assoc()['nazwa_utworu'] ."</b></p></br>";
                                            $result->data_seek($b);
                                            echo "<p class='statystyka' style='font-size: 17px;'>Autor: <b style='color: #30badf; float:right;'>".$result->fetch_assoc()['autor']."</b></p></br>";
                                            $result->data_seek($b);
                                            echo "<p class='statystyka'  style='font-size: 17px;'>Utwór znajdziesz w: <b style='color: #30badf; float:right;'>".($ksiega=$result->fetch_assoc()['ksiazka'])."</b></p></br>";
                                    
                                            $result->data_seek($b); 
                                    
                                            $query_lokalizacja = "SELECT * FROM ksiazki WHERE tytul='$ksiega'";
                                            $result_1= $archiwum_X->query($query_lokalizacja);
                                            if(!$result_1) die($archiwum_X->error);
                                            echo "<p class='statystyka' style='font-size: 17px;'>W miejscu: <b style='color: #30badf; float:right; text-align: center;'>". $result_1->fetch_assoc()['lokalizacja']   ."</b></p></br><hr style='height: 0px; border-top:2px solid #07bf2c;'/></br>";
                                            $result_1->data_seek($a);
                                        
                                        
                                    }
                                    echo "</div>
                                    <a href='log.php'><div class='zamknij'>Zamknij</div></a>
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
                                        <a href='log.php'><div class='zamknij'>Zamknij</div></a>
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
                                        
                                        $a;   
                                        for($b=0; $b<$ile_piosenek; $b++)
                                        {
                                            $result->data_seek($b);
                                            echo "<p class='statystyka' style='font-size: 17px;'>Tytuł: <b style='color: #30badf; float:right;'>". $result->fetch_assoc()['nazwa_utworu'] ."</b></p></br>";
                                            $result->data_seek($b);
                                            echo "<p class='statystyka' style='font-size: 17px;'>Autor: <b style='color: #30badf; float:right;'>".$result->fetch_assoc()['autor']."</b></p></br>";
                                            $result->data_seek($b);
                                            echo "<p class='statystyka'  style='font-size: 17px;'>Utwór znajdziesz w: <b style='color: #30badf; float:right;'>".($ksiega=$result->fetch_assoc()['ksiazka'])."</b></p></br>";
                                    
                                            $result->data_seek($b); 
                                    
                                            $query_lokalizacja = "SELECT * FROM ksiazki WHERE tytul='$ksiega'";
                                            $result_1= $archiwum_X->query($query_lokalizacja);
                                            if(!$result_1) die($archiwum_X->error);
                                            echo "<p class='statystyka' style='font-size: 17px;'>W miejscu: <b style='color: #30badf; float:right; text-align: center;'>". $result_1->fetch_assoc()['lokalizacja']   ."</b></p></br><hr style='height: 0px; border-top:2px solid #07bf2c;'/></br>";
                                            $result_1->data_seek($a);
                                            
                                        } 
                                        echo "</div>
                                        <a href='log.php'><div class='zamknij'>Zamknij</div></a>
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
            <h2 class="temat">Statystyki...</h2>

            <form action="log.php" method="post"><!--Wyszukiwanie ALPHA--><!--
                <input class="dodaj_utw_form" placeholder="Szukaj" type="search" name="poszukiwane" required title="Wyszukaj"/>
                <input class="button_wyszukaj" type="submit" name="wyszukaj" value="Szukaj"/>
                -->
            </form>
            <?php
                            require_once 'connect.php';
                            $archiwum_X= new mysqli($hostname, $user, $passwusr, $dbname);
                            if($archiwum_X->connect_error) die($archiwum_X->connect_error);
                            $archiwum_X->set_charset('utf8');
                            $query = "SELECT * FROM utwory_x";
                            $result= $archiwum_X->query($query);
                            if(!$result) die($archiwum_X->error);
                            $rows =$result->num_rows;

                            
                              
                            $licznik=0;
                            $x=0;
                            $y=0;
                            
                           
                            for($b=0; $b<$rows; $b++)
                            {
                            }
                            echo "<p class='statystyka'>Utworów w bazie:  <b style='color: #30badf; float:right;'>".$b."</b></p>";



                             $query = "SELECT * FROM ksiazki";
                            $result= $archiwum_X->query($query);
                            if(!$result) die($archiwum_X->error);
                            $rows =$result->num_rows;

                            
                              
                            $licznik=0;
                            $x=0;
                            $y=0;
                            
                           
                            for($a=0; $a<$rows; $a++)
                            {
                            }
                            echo "<p class='statystyka'>Książek w bazie:  <b style='color: #30badf; float:right;'>".$a."</b></p>";

                            //Poszczególne
                            
  
                            $query = "SELECT * FROM ksiazki ORDER BY rok DESC";
                            $result= $archiwum_X->query($query);
                            if(!$result) die($archiwum_X->error);
                            $rows =$result->num_rows;

                                                           
                            
                            for($c=0; $c<$rows; $c++)
                            {
                            $result->data_seek($c);
							$id_ksiega=$result->fetch_assoc()['id_ksiazki'];
							$result->data_seek($c);
							$ksiega=$result->fetch_assoc()['tytul'];
                            echo "<a class='spis_ksiazki' href='wykaz.php?id=$id_ksiega'><p class='statystyka_podtemat' style='margin: 5px 25px 10px 85px; font-size: 14px; '>".$ksiega;


                            $query = "SELECT * FROM utwory_x WHERE ksiazka='$ksiega'";
                            $result1= $archiwum_X->query($query);
                            if(!$result1) die($archiwum_X->error);
                            $rows1 =$result1->num_rows;
                            echo "<b style='color: #30badf; float:right;'>".$rows1."</b></p></a>";
                            
                            }


                            $query = "SELECT * FROM ksiazki WHERE archiwizacja='TAK'";
                            $result= $archiwum_X->query($query);
                            if(!$result) die($archiwum_X->error);
                            $rows =$result->num_rows;
                            echo "<p class='statystyka_podtemat'>Archiwizowanych:  <b style='color: #30badf; float:right;'>".$rows."</b></p>";
                            
                                                                
                                                              
                           
                                $result->close();
                                $archiwum_X->close();  
                            
                    
                            
                   

            ?>
            <!--<h4 class="info_h4">Tutaj zostały przedstawione statystyki dotyczące Twojego dotychczasowego zbioru nut.</h4>-->
        </div>

        <div class="trzeci-box"><!--Dolny box-->

            <h2 class="temat">Dotychczas zapisane utwory...</h2>
            <?php
            
                    require_once 'connect.php';
                            $archiwum_X= new mysqli($hostname, $user, $passwusr, $dbname);
                            if($archiwum_X->connect_error) die($archiwum_X->connect_error);

                            $archiwum_X->set_charset('utf8');
                            
                            //$archiwum_X = mb_convert_encoding($archiwum_X, 'UTF-8', mb_detect_encoding( $archiwum_X));
                            


                            $query = "SELECT * FROM utwory_x ORDER BY nazwa_utworu";
                            $result= $archiwum_X->query($query);
                            if(!$result) die($archiwum_X->error);
                            $rows =$result->num_rows;
                            
                            
                              
                            $licznik=0;
                            $x=0;
                            $y=0;
                            
                            echo "<table class='tabela_utworow'><tr id='inne_tr'><th>Nr</th><th>Utwór</th><th>Autor</th><th>Książka</th><th>Lokalizacja</th></tr>";
                            
                            for($b=0; $b<$rows; $b++)
                            {
                                    
                                    echo "<tr>";
                                    echo "<td>".($b+1)."</td>";
                                    $result->data_seek($b);
                                    echo '<td>'. $result->fetch_assoc()['nazwa_utworu'] .'</td>';
                                    $result->data_seek($b);
                                    echo '<td>'.$result->fetch_assoc()['autor']  .'</td>';
                                    $result->data_seek($b);
                                    echo '<td> '.($ksiega=$result->fetch_assoc()['ksiazka']).'</td>';
                                    
                                    $result->data_seek($b);
                                    
                                    $query_lokalizacja = "SELECT * FROM ksiazki WHERE tytul='$ksiega'";
                                    $result_1= $archiwum_X->query($query_lokalizacja);
                                    if(!$result_1) die($archiwum_X->error);
                                    echo '<td> '. $result_1->fetch_assoc()['lokalizacja']   .'</td>';
 
                                    $result_1->data_seek($b);
                                    echo "</tr>";


                            }
                           
                            echo "</table>";
                            

                            $result->close();
                            $archiwum_X->close();                            
                            

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
        <small style="color: white; font-family: Calibri; font-size: 15px;">Copyright &copy; Jakub Kaniowski 2016.  Potato Corporation&reg;</small>
    </div><!--Koniec Sekcji Stopki-->
    

</body>
</html>