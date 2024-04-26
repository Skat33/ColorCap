<?php
                    $mecze1 = array( // Faza grupowa
                     1 => array("Team1" => "Czechy", "Team2" => "Belgia"), // Team1 VS Team2 - Uzupełnij zgodnie z tym formatem dane
                     2 => array("Team1" => "Niemcy", "Team2" => "Hiszpania"),
                     3 => array("Team1" => "Szkocja", "Team2" => "Francja"),
                     4 => array("Team1" => "Holandia", "Team2" => "Anglia"),
                     5 => array("Team1" => "Włochy", "Team2" => "Turcja"),
                     6 => array("Team1" => "Chorwacja", "Team2" => "Albania"),
                     7 => array("Team1" => "Czechy", "Team2" => "Belgia"),
                     8 => array("Team1" => "Austria", "Team2" => "Węgry"),
                     9 => array("Team1" => "Serbia", "Team2" => "Dania"),
                     10 => array("Team1" => "Słowenia", "Team2" => "Rumunia"),
                     11 => array("Team1" => "Szwajcaria", "Team2" => "Portugalia"),
                     12 => array("Team1" => "Słowacja", "Team2" => "Polska"),
                     13 => array("Team1" => "Ukraina", "Team2" => "Gruzja"),
                 ); 
                 $mecze2 = array( // 1/8
                  1 => array("Team1" => "Czechy", "Team2" => "Belgia"), // Team1 VS Team2 - Uzupełnij zgodnie z tym formatem dane
                  2 => array("Team1" => "Niemcy", "Team2" => "Hiszpania"),
                  3 => array("Team1" => "Szkocja", "Team2" => "Francja"),
                  4 => array("Team1" => "Holandia", "Team2" => "Anglia"),
                  5 => array("Team1" => "Włochy", "Team2" => "Turcja"),
                  6 => array("Team1" => "Chorwacja", "Team2" => "Albania"),
                  7 => array("Team1" => "Czechy", "Team2" => "Belgia"),
                  8 => array("Team1" => "Austria", "Team2" => "Węgry"),
              ); 
              $mecze3 = array( //ćwierć-finały
               1 => array("Team1" => "Czechy", "Team2" => "Belgia"), // Team1 VS Team2 - Uzupełnij zgodnie z tym formatem dane
               2 => array("Team1" => "Niemcy", "Team2" => "Hiszpania"),
               3 => array("Team1" => "Szkocja", "Team2" => "Francja"),
               4 => array("Team1" => "Holandia", "Team2" => "Anglia"),
           ); 
           $mecze4 = array( //Pół finały
            1 => array("Team1" => "Czechy", "Team2" => "Belgia"), // Team1 VS Team2 - Uzupełnij zgodnie z tym formatem dane
            2 => array("Team1" => "Niemcy", "Team2" => "Hiszpania"),
        ); 
        $mecze5 = array( // Finały
         1 => array("Team1" => "Czechy", "Team2" => "Belgia"), // Team1 VS Team2 - Uzupełnij zgodnie z tym formatem dane
     ); 
                 $wynikiRzeczywiste = array(
                    1=> array("Wynik1" => 2, "Wynik2" => 2),
                    2=> array("Wynik1" => 1, "Wynik2" => 3),
                    3=> array("Wynik1" => 3, "Wynik2" => 2),
                    4=> array("Wynik1" => 4, "Wynik2" => 2),
                    5=> array("Wynik1" => 0, "Wynik2" => 2),
                    6=> array("Wynik1" => 4, "Wynik2" => 3),
                    7=> array("Wynik1" => 0, "Wynik2" => 1),
                    8=> array("Wynik1" => 8, "Wynik2" => 2),
                    9=> array("Wynik1" => 2, "Wynik2" => 2),
                    10=> array("Wynik1" => 2, "Wynik2" => 1),
                    11=> array("Wynik1" => 10, "Wynik2" => 4),
                    12=> array("Wynik1" => 1, "Wynik2" => 4),
                    13=> array("Wynik1" => 1, "Wynik2" => 1),
                    14=> array("Wynik1" => 1, "Wynik2" => 3),
                    15=> array("Wynik1" => 1, "Wynik2" => 1),
                    16=> array("Wynik1" => 1, "Wynik2" => 3)
                 );

                 $mistrz_faktyczny = "Niemcy"; #Tutaj należy wpisać faktycznego zwyciężce Mistrzostw
                 $data_obstawienia = "2024-04-28 8:30:00"; # Tutaj należy ustawić, do kiedy można obstawiać mecze.
                 $stawka = 20; #Tutaj należy podać stawke, która ma się wyświetlać na stronie z obstawianiem
                 $runda = 2; #Tutaj ustaw rundę/etap Turnieju.
                 $zmienna = "mecze".$runda;
                 $mecze = $$zmienna;

                 // Sesja

 



                  // Wylogowanie uzytkownika po kliknieciu wyloguj
                  // Rozpoczęcie sesji

?>