   <?php


                  $mistrz_faktyczny = "Belgia"; #Tutaj należy wpisać faktycznego zwyciężce Mistrzostw
                  $data_obstawienia = "2024-04-30 15:00:00"; # Tutaj należy ustawić, do kiedy można obstawiać mecze. Koniecznie to ma być format - "Rok-Miesiąc-Dzień Godzina-Minuta-Sekunda"
                  $stawka = 20; #Tutaj należy podać stawke, która ma się wyświetlać na stronie z obstawianiem
                  $runda = 1; #Tutaj ustaw rundę/etap Turnieju.
                  $admin = "Skat33"; #Tutaj ustaw nazwę użytkownika, który ma być adminem

                     $mecze1 = array( // Faza grupowa
                        1 => array("Team1" => "Niemcy", "Team2" => "Szkocja"), // Team1 VS Team2 - Uzupełnij zgodnie z tym formatem dane
                        2 => array("Team1" => "Węgry", "Team2" => "Szwajcaria"),
                        3 => array("Team1" => "Hiszpania", "Team2" => "Chorwacja"),
                        4 => array("Team1" => "Włochy", "Team2" => "Albania"),
                        5 => array("Team1" => "Polska", "Team2" => "Holandia"),
                        6 => array("Team1" => "Słowenia", "Team2" => "Dania"),
                        7 => array("Team1" => "Serbia", "Team2" => "Anglia"),
                        8 => array("Team1" => "Rumunia", "Team2" => "Ukraina"),
                        9 => array("Team1" => "Belgia", "Team2" => "Słowacja"),
                        10 => array("Team1" => "Austria", "Team2" => "Francja"),
                        11 => array("Team1" => "Turcja", "Team2" => "Gruzja"),
                        12 => array("Team1" => "Portugalia", "Team2" => "Czechy"),
                        13 => array("Team1" => "Chorwacja", "Team2" => "Albania"),
                        14 => array("Team1" => "Niemcy", "Team2" => "Węgry"),
                        15 => array("Team1" => "Szkocja", "Team2" => "Szwajcaria"),
                        16 => array("Team1" => "Słowenia", "Team2" => "Serbia"),
                        17 => array("Team1" => "Dania", "Team2" => "Anglia"),
                        18 => array("Team1" => "Hiszpania", "Team2" => "Włochy"),
                        19 => array("Team1" => "Słowacja", "Team2" => "Ukraina"),
                        20 => array("Team1" => "Polska", "Team2" => "Austria"),
                        21 => array("Team1" => "Holandia", "Team2" => "Francja"),
                        22 => array("Team1" => "Gruzja", "Team2" => "Czechy"),
                        23 => array("Team1" => "Turcja", "Team2" => "Portugalia"),
                        24 => array("Team1" => "Belgia", "Team2" => "Rumunia"),
                        25 => array("Team1" => "Szwajcaria", "Team2" => "Niemcy"),
                        26 => array("Team1" => "Szkocja", "Team2" => "Węgry"),
                        27 => array("Team1" => "Albania", "Team2" => "Hiszpania"),
                        28 => array("Team1" => "Chorwacja", "Team2" => "Włochy"),
                        29 => array("Team1" => "Holandia", "Team2" => "Austria"),
                        30 => array("Team1" => "Francja", "Team2" => "Polska"),
                        31 => array("Team1" => "Anglia", "Team2" => "Słowenia"),
                        32 => array("Team1" => "Dania", "Team2" => "Serbia"),
                        33 => array("Team1" => "Słowacja", "Team2" => "Rumunia"),
                        34 => array("Team1" => "Ukraina", "Team2" => "Belgia"),
                        35 => array("Team1" => "Czechy", "Team2" => "Turcja"),
                        36 => array("Team1" => "Gruzja", "Team2" => "Portugalia"),
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
                     1=> array("Wynik1" => -1, "Wynik2" => -1),
                     2=> array("Wynik1" => -1, "Wynik2" => -1),
                     3=> array("Wynik1" => -1, "Wynik2" => -1),
                     4=> array("Wynik1" => -1, "Wynik2" => -1),
                     5=> array("Wynik1" => -1, "Wynik2" => -1),
                     6=> array("Wynik1" => -1, "Wynik2" => -1),
                     7=> array("Wynik1" => -1, "Wynik2" => -1),
                     8=> array("Wynik1" => -1, "Wynik2" => -1),    // Aby wynik nie był liczony, ponieważ nie znamy wyniki rzeczywistego, w miejscu wyniki rzeczywiste należy dać wartość 
                     9=> array("Wynik1" => -1, "Wynik2" => -1),   // ujemną dowolnego wyniku drużyny, a cały Wynik zostanie uznany za "Nieznany", a przy zmianie wyniku dane się zaktualizują.
                     10=> array("Wynik1" => -1, "Wynik2" => -1),
                     11=> array("Wynik1" => -1, "Wynik2" => -1),
                     12=> array("Wynik1" => -1, "Wynik2" => -1),
                     13=> array("Wynik1" => -1, "Wynik2" => -1),
                     14=> array("Wynik1" => -1, "Wynik2" => -1),
                     15=> array("Wynik1" => -1, "Wynik2" => -1),
                     16=> array("Wynik1" => -1, "Wynik2" => -1),
                     17=> array("Wynik1" => -1, "Wynik2" => -1),
                     18=> array("Wynik1" => -1, "Wynik2" => -1),
                     19=> array("Wynik1" => -1, "Wynik2" => -1),
                     20=> array("Wynik1" => -1, "Wynik2" => -1),
                     21=> array("Wynik1" => -1, "Wynik2" => -1),
                     22=> array("Wynik1" => -1, "Wynik2" => -1),
                     23=> array("Wynik1" => -1, "Wynik2" => -1),
                     24=> array("Wynik1" => -1, "Wynik2" => -1),    // Aby wynik nie był liczony, ponieważ nie znamy wyniki rzeczywistego, w miejscu wyniki rzeczywiste należy dać wartość 
                     25=> array("Wynik1" => -1, "Wynik2" => -1),   // ujemną dowolnego wyniku drużyny, a cały Wynik zostanie uznany za "Nieznany", a przy zmianie wyniku dane się zaktualizują.
                     26=> array("Wynik1" => -1, "Wynik2" => -1),
                     27=> array("Wynik1" => -1, "Wynik2" => -1),
                     28=> array("Wynik1" => -1, "Wynik2" => -1),
                     29=> array("Wynik1" => -1, "Wynik2" => -1),
                     30=> array("Wynik1" => -1, "Wynik2" => -1),
                     31=> array("Wynik1" => -1, "Wynik2" => -1),
                     32=> array("Wynik1" => -1, "Wynik2" => -1),
                     33=> array("Wynik1" => -4, "Wynik2" => -1),
                     34=> array("Wynik1" => -1, "Wynik2" => -2),
                     35=> array("Wynik1" => -2, "Wynik2" => -1),
                     36=> array("Wynik1" => -2, "Wynik2" => -2)
                  );
                  $wynikiRzeczywiste2 = array( // Wynik1 to liczba bramek faktyczna drużyny 1, która jest podana wyżej jako team1 a wynik 2 to drużyna 2 // 1/8
                     1=> array("Wynik1" => 2, "Wynik2" => 3),
                     2=> array("Wynik1" => 1, "Wynik2" => 3),
                     3=> array("Wynik1" => 3, "Wynik2" => 1), // Aby wynik nie był liczony, ponieważ nie znamy wyniki rzeczywistego, w miejscu wyniki rzeczywiste należy dać wartość 
                     4=> array("Wynik1" => 3, "Wynik2" => 2), // ujemną dowolnego wyniku drużyny, a cały Wynik zostanie uznany za "Nieznany", a przy zmianie wyniku dane się zaktualizują.
                     5=> array("Wynik1" => 0, "Wynik2" => 2),
                     6=> array("Wynik1" => 3, "Wynik2" => 1),
                     7=> array("Wynik1" => -3, "Wynik2" => -1),
                     8=> array("Wynik1" => -1, "Wynik2" => -1)
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



                  $zmienna = "mecze".$runda; // Zrobione specjalnie, aby w przypadku zmiany rundy, strona pobierała mecze z innej tablicy, która dotyczy danej rundy.
                  $mecze = $$zmienna;
                  $zmienna2 = "wynikiRzeczywiste".$runda;
                  $wynikiRzeczywiste = $$zmienna2;
                  ?>