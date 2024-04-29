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
                 $wynikiRzeczywiste1 = array( // Wynik1 to liczba bramek faktyczna drużyny 1, która jest podana wyżej jako team1 a wynik 2 to drużyna 2 // Faza grupowa
                    1=> array("Wynik1" => 2, "Wynik2" => 2),
                    2=> array("Wynik1" => 1, "Wynik2" => 3),
                    3=> array("Wynik1" => 3, "Wynik2" => 2),
                    4=> array("Wynik1" => 4, "Wynik2" => 2),
                    5=> array("Wynik1" => 0, "Wynik2" => 2),
                    6=> array("Wynik1" => 4, "Wynik2" => 3),
                    7=> array("Wynik1" => 0, "Wynik2" => 1),
                    8=> array("Wynik1" => 8, "Wynik2" => 2),    // Aby wynik nie był liczony, ponieważ nie znamy wyniki rzeczywistego, w miejscu wyniki rzeczywiste należy dać wartość 
                    9=> array("Wynik1" => 2, "Wynik2" => 2),   // ujemną dowolnego wyniku drużyny, a cały Wynik zostanie uznany za "Nieznany", a przy zmianie wyniku dane się zaktualizują.
                    10=> array("Wynik1" => 2, "Wynik2" => 1),
                    11=> array("Wynik1" => 10, "Wynik2" => 4),
                    12=> array("Wynik1" => 3, "Wynik2" => 1),
                    13=> array("Wynik1" => 1, "Wynik2" => 1),
                    14=> array("Wynik1" => 1, "Wynik2" => 3),
                    15=> array("Wynik1" => 1, "Wynik2" => 1),
                    16=> array("Wynik1" => 1, "Wynik2" => 3)
                 );
                 $wynikiRzeczywiste2 = array( // Wynik1 to liczba bramek faktyczna drużyny 1, która jest podana wyżej jako team1 a wynik 2 to drużyna 2 // 1/8
                    1=> array("Wynik1" => 2, "Wynik2" => 2),
                    2=> array("Wynik1" => 1, "Wynik2" => 3),
                    3=> array("Wynik1" => 3, "Wynik2" => 1), // Aby wynik nie był liczony, ponieważ nie znamy wyniki rzeczywistego, w miejscu wyniki rzeczywiste należy dać wartość 
                    4=> array("Wynik1" => 3, "Wynik2" => 2), // ujemną dowolnego wyniku drużyny, a cały Wynik zostanie uznany za "Nieznany", a przy zmianie wyniku dane się zaktualizują.
                    5=> array("Wynik1" => 0, "Wynik2" => 2),
                    6=> array("Wynik1" => 3, "Wynik2" => 1),
                    7=> array("Wynik1" => -1, "Wynik2" => 1),
                    8=> array("Wynik1" => -1, "Wynik2" => 2)
                 );
                 $wynikiRzeczywiste3 = array( // Wynik1 to liczba bramek faktyczna drużyny 1, która jest podana wyżej jako team1 a wynik 2 to drużyna 2 // 1/4
                    1=> array("Wynik1" => 1, "Wynik2" => 2),
                    2=> array("Wynik1" => 3, "Wynik2" => 3), // Aby wynik nie był liczony, ponieważ nie znamy wyniki rzeczywistego, w miejscu wyniki rzeczywiste należy dać wartość 
                    3=> array("Wynik1" => 2, "Wynik2" => 1),// ujemną dowolnego wyniku drużyny, a cały Wynik zostanie uznany za "Nieznany", a przy zmianie wyniku dane się zaktualizują.
                    4=> array("Wynik1" => 4, "Wynik2" => 2)
                 );
                 $wynikiRzeczywiste4 = array( // Wynik1 to liczba bramek faktyczna drużyny 1, która jest podana wyżej jako team1 a wynik 2 to drużyna 2 // Półfinaly
                    1=> array("Wynik1" => 2, "Wynik2" => 2),
                    2=> array("Wynik1" => -3, "Wynik2" => 1)
                 );
                 $wynikiRzeczywiste5 = array( // Wynik1 to liczba bramek faktyczna drużyny 1, która jest podana wyżej jako team1 a wynik 2 to drużyna 2 // Finały
                    1=> array("Wynik1" => 1, "Wynik2" => -1)
                 );

                 $mistrz_faktyczny = "Belgia"; #Tutaj należy wpisać faktycznego zwyciężce Mistrzostw
                 $data_obstawienia = "2024-04-29 15:00:00"; # Tutaj należy ustawić, do kiedy można obstawiać mecze.
                 $stawka = 20; #Tutaj należy podać stawke, która ma się wyświetlać na stronie z obstawianiem
                 $runda = 1; #Tutaj ustaw rundę/etap Turnieju.
                 $admin = "Skat33"; #Tutaj ustaw nazwę użytkownika, który ma być adminem


                 $zmienna = "mecze".$runda;
                 $mecze = $$zmienna;
                 $zmienna2 = "wynikiRzeczywiste".$runda;
                 $wynikiRzeczywiste = $$zmienna2;
                 ?>