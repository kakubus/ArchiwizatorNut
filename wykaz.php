<!DOCTYPE html>
<?php
session_start(); 
				echo "<div style='display: none;'>";
				require_once 'connect.php';   
				global $hostname, $user, $passwusr, $dbname;
				$archiwum_X1= new mysqli($hostname, $user, $passwusr, $dbname);
				$archiwum_X1->set_charset('utf8');
		
                $fraza=$_GET['id'];
				
                $fraza= htmlentities($fraza, ENT_QUOTES, "UTF-8");

				
				$query_ksiazka1 = "SELECT * FROM ksiazki WHERE id_ksiazki='$fraza'";
				$result_ksiazka1= $archiwum_X1->query($query_ksiazka1);
         
                $rows_ksiazka1 =$result_ksiazka1->num_rows;
				
				if($rows_ksiazka1==1)
				{
					$dane=$result_ksiazka1->fetch_array(MYSQLI_ASSOC);
					$ksiazka=$dane['tytul'];
					$ksiazka_edit = substr($ksiazka, 0, -4);
					$ksiazka_edit = $ksiazka;

					$rok_ksiazki=$dane['rok'];
					$ajdi=$dane['id_ksiazki'];
					$lokalizacja=$dane['lokalizacja'];
					$archiwizacja=$dane['archiwizacja'];
				}	
				echo "</div>";

			function wykaz(){

				require_once 'connect.php';   
				global $hostname, $user, $passwusr, $dbname;
				$archiwum_X= new mysqli($hostname, $user, $passwusr, $dbname);
				if($archiwum_X->connect_error) die($archiwum_X->connect_error);
				$archiwum_X->set_charset('utf8');
                $fraza=$_GET['id'];
				
                $fraza= htmlentities($fraza, ENT_QUOTES, "UTF-8");

				
				$query_ksiazka = "SELECT * FROM ksiazki WHERE id_ksiazki='$fraza'";
				$result_ksiazka= $archiwum_X->query($query_ksiazka);
                if(!$result_ksiazka) die($archiwum_X->error);
                $rows_ksiazka =$result_ksiazka->num_rows;

				if($rows_ksiazka==1)
				{
					$nazwa_ksiazki=$result_ksiazka->fetch_assoc()['tytul'];
					

					$query_spis = "SELECT * FROM utwory_x WHERE ksiazka='$nazwa_ksiazki'";
					$result= $archiwum_X->query($query_spis);
					if(!$result) die($archiwum_X->error);
					$rows =$result->num_rows;
					
                    if($rows>0){
					            
					for($a=0; $a<$rows; $a++){
						$wiersz= $result->fetch_array(MYSQLI_ASSOC);
						echo "<p class='wykaz_p' title='Kliknij, aby zobaczyć zawartość książki.'><span class='licznik'>".($a+1)."</span> ".$wiersz['nazwa_utworu']." ";
						echo  "<span class='wykaz_span'>".$wiersz['autor']."</span></p>";       
					}
					}
					else{
						echo "<p class='wykaz_p'>Brak zawartości!</p>";
					}

				}
				else
				{
					echo "Wystąpiły pewne nieprawidłowości. Jeśli problem się powtórzy, skontaktuj się z administratorem";
				}
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
</head>
<body>

    <div id="naglowek"><!--Sekcja nagłówka-->
        
        <a href="glowna.php" id="logo">Strona Internetowa</a>    

        <div id="menu">
		<?php
		 require_once 'connect.php';
		 if(isset($_SESSION["zalogowany"]))
                    {
                       echo "
					   <ul>
							<li><a href='javascript:history.go(-1);' class='navi'>Powrót do poprzedniej strony</h2></a></li>
						</ul>";

                    }
                    else
                    {
                        echo "<h4 class='info_h4' style='padding-top: 5px; font-style: normal; font-size: 18px;'>".$ksiazka."</h4>";
                    }   
            
		
             

  ?>
            

        </div>
    </div><!--Koniec Nagłówka-->


    <div id="zawartosc"'><!--Sekcja Głównej Zawartości-->

		<div style='margin: 20px;'>
		<h2 class="temat">Wykaz książkowy </h2>

		
            <div id='obraz_ksiazka'>
			
				<p id='skr_tyt'><?php echo $ksiazka_edit; ?></p>
				<p id='skr_rok'><?php echo $rok_ksiazki; ?></p>
				<p id='skr_user'>Kuba Kaniowski</p>
			</div>
			
			<br/>
            <div id='wykaz'>
			<h2 class="temat" style='color:#ebb32d; '>Spis treści</h2>
            <?php wykaz(); ?>
			
			</div>

			
            
        </div>

       

        <div class="trzeci-box" style='text-align: center;' ><!--Dolny box-->
				<p class="statystyka">Informacje</p>
				<?php
					echo "<p class='statystyka_podtemat' style='margin: 0px auto; font-size: 14px; width: 250px; color:#ebb32d; '>ID w bazie: <b style='color: #30badf; float:right;'>".$ajdi."</b></p>";
					echo "<p class='statystyka_podtemat' style='margin: 0px auto; font-size: 14px; width: 250px; color:#ebb32d;'>Lokalizacja: <b style='color: #30badf; float:right;'>".$lokalizacja."</b></p>";
					echo "<p class='statystyka_podtemat' style='margin: 0px auto; font-size: 14px; width: 250px; color:#ebb32d; '>Archiwizacja: <b style='color: #30badf; float:right;'>".$archiwizacja."</b></p>";
			

				
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
        <small style="color: white; font-family: Calibri; font-size: 15px;">Copyright &copy; Jakub Kaniowski 2018.  Potato Corporation&reg;</small>
    </div><!--Koniec Sekcji Stopki-->
    

</body>
</html>