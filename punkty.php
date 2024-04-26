<?php
include 'dane_mistrzostwa.php';
               foreach ($wynikiRzeczywiste as $id_meczu => $wynik) {
                  $wynik_faktyczny = $wynik['Wynik1'] . ' - ' . $wynik['Wynik2'];
                  $update_query = "UPDATE runda$runda SET Wynik_faktyczny_Team1 = '{$wynik['Wynik1']}', Wynik_faktyczny_Team2 = '{$wynik['Wynik2']}' WHERE ID_betu = $id_meczu";
                  mysqli_query($conn, $update_query);
              }
    $sql_users = "SELECT DISTINCT ID FROM runda$runda";
    $query_users = mysqli_query($conn, $sql_users);
    
    while ($row_user = mysqli_fetch_assoc($query_users)) {
        $user_id = $row_user['ID'];
    
        // Pobierz zakłady dla danego użytkownika
        $sql_bets = "SELECT * FROM runda$runda WHERE ID = $user_id";
        $query_bets = mysqli_query($conn, $sql_bets);
    
        // Zainicjuj zmienne punktów dla danego użytkownika
        $wytypowany_mistrz = "SELECT * FROM runda1 WHERE ID = $user_id";
        $wytypowany_result = mysqli_query($conn, $wytypowany_mistrz);

        $punkty = 0;
        $punkty_dodane_mistrz = false;
        while (        $row_mistrz = mysqli_fetch_assoc($wytypowany_result)){
            $mistrz = $row_mistrz['Wytypowany_Mistrz'];
            if (!$punkty_dodane_mistrz && $mistrz == $mistrz_faktyczny){
                $punkty+=10;
                $punkty_dodane_mistrz = true;
            }
          }
        // Iteruj przez zakłady danego użytkownika
        while ($row = mysqli_fetch_assoc($query_bets)) {
            // Tutaj umieść kod obliczający punkty na podstawie zakładów
            $wynik1 = $row['Wynik_Typowany_Team1'];
            $wynik2 = $row['Wynik_Typowany_Team2'];
            $team1 = $row['Team_1'];
            $team2 = $row['Team_2'];
            $punkty2="";
            $id = $row['ID'];
            $punkty_dodane = false;
            $bet = $row['ID_betu'];
    
            if ($punkty_dodane == true) {
                 
                break;
            }
        
            $wynik_real1 = $row['Wynik_faktyczny_Team1'];
            $wynik_real2 = $row['Wynik_faktyczny_Team2'];
            
            if (($team1 === "Polska" or $team2 === "Polska") && (($wynik1 > $wynik2 && $wynik_real1 > $wynik_real2) || ($wynik2 > $wynik1 && $wynik_real2 > $wynik_real1))) {
                $punkty_dodane = true;
                $punkty2 .= "  +1 (Reprezentacja)<br>  ";
                $punkty += 1;
            }
            
            if ($wynik1 == $wynik_real1 && $wynik2 == $wynik_real2) {
                $punkty_dodane = true;
                $punkty2 .= "  +4 (Wynik) ";
                $punkty += 4;
            }
            else if ($wynik1 == $wynik2 && $wynik_real1 == $wynik_real2) {
                $punkty_dodane = true;
                $punkty2 .= "  +2 (Remis) ";
                $punkty += 2;
            }
            else if (abs($wynik1 - $wynik2) >= 2 && abs($wynik_real1 - $wynik_real2) >= 2  && (abs($wynik1 - $wynik2) == abs($wynik_real1 - $wynik_real2)) && (($wynik1 > $wynik2 && $wynik_real1 > $wynik_real2) || ($wynik2 > $wynik1 && $wynik_real2 > $wynik_real1))) {
                $punkty_dodane = true;
                $punkty2 .= "  +2 (Różnica) ";
                $punkty += 2;
            }
            else if (($wynik1 > $wynik2 && $wynik_real1 > $wynik_real2) || ($wynik2 > $wynik1 && $wynik_real2 > $wynik_real1)) {
                $punkty_dodane = true;
                $punkty2 .= "  +1  (Wygrana) ";
                $punkty +=1;
                
            }

            else if($punkty_dodane == false){
             $punkty2 ="0";
            }
            $punkty_dodane_sql = "UPDATE runda$runda SET Punkty_Dodane = '$punkty2 ' WHERE ID_betu = $bet AND ID=$user_id";
            mysqli_query($conn, $punkty_dodane_sql);
    
            $punkty_update = "UPDATE runda$runda SET Punkty = $punkty WHERE ID = $user_id";
            $punkty_result = mysqli_query($conn, $punkty_update);
            $update_punkty = "UPDATE runda$runda SET Punkty = $punkty WHERE ID = $user_id";
            mysqli_query($conn, $update_punkty);
            $update_punkty2 = "UPDATE wyniki SET `Runda_$runda` = $punkty WHERE  ID = $user_id";
            mysqli_query($conn, $update_punkty2);
        }
    }
?>