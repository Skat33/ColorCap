    <?php
    include 'dane_mistrzostwa.php';

    if (isset($_GET['selected-rounds'])) {
        $wybrana_runda = $_GET['selected-rounds'];
    } else {
        $wybrana_runda = $runda;
    }
    if (isset($_GET['users'])) {
        $id_user = $_GET['users'];
        $dane = "SELECT * FROM users WHERE ID = $id_user";
        $dane_result = mysqli_query($conn, $dane);
        $row_dane = mysqli_fetch_assoc($dane_result);
        $user_name = $row_dane['Imie'];
        $user_surname = $row_dane['Nazwisko'];
    } else {
        $id_user = $user_id;
        $user_name = $imie;
        $user_surname = $nazwisko;
    }

    // Pobieranie danych na podstawie wybranej rundy
    $zmienna = "wynikiRzeczywiste".$wybrana_runda;
    $wynikiRzeczywiste = $$zmienna;
    $zmienna2 = "mecze$wybrana_runda";
    $mecze = $$zmienna2;
        $sql_users = "SELECT DISTINCT ID FROM runda$wybrana_runda";
        $query_users = mysqli_query($conn, $sql_users);
        
        // Iteracja przez wyniki rzeczywiste i aktualizowanie danych w bazie danych dla każdego użytkownika
        foreach ($wynikiRzeczywiste as $wyniki_key => $wyniki_update) {
            $wynik_rzeczywisty1 = $wyniki_update['Wynik1'];
            $wynik_rzeczywisty2 = $wyniki_update['Wynik2'];
            $update = "UPDATE runda$wybrana_runda SET `Wynik_faktyczny_Team1` = $wynik_rzeczywisty1, `Wynik_faktyczny_Team2` = $wynik_rzeczywisty2 WHERE ID_betu = $wyniki_key AND ID = $id_user";
            $conn->query($update);
            }
            
        while ($row_user = mysqli_fetch_assoc($query_users)) {
            $user_id = $row_user['ID'];
        
            // Pobierz zakłady dla danego użytkownika
            $sql_bets = "SELECT * FROM runda$wybrana_runda WHERE ID = $user_id";
            $query_bets = mysqli_query($conn, $sql_bets);
        
            // Zainicjuj zmienne punktów dla danego użytkownika
            $wytypowany_mistrz = "SELECT * FROM runda1 WHERE ID = $user_id";
            $wytypowany_result = mysqli_query($conn, $wytypowany_mistrz);

            $punkty = 0;

            // Iteruj przez zakłady danego użytkownika
            while ($row = mysqli_fetch_assoc($query_bets)) {
                // Tutaj umieść kod obliczający punkty na podstawie zakładów
                $wynik1 = $row['Wynik_Typowany_Team1'];
                $wynik2 = $row['Wynik_Typowany_Team2'];
                $team1 = $row['Team_1'];
                $team2 = $row['Team_2'];
                $punkty2="";
                $id = $row['ID'];
                $wynik = $row['Wynik'];
                $punkty_dodane = false;
                $bet = $row['ID_betu'];
                
                if ($punkty_dodane == true) {
                    
                    break;
                }
                if ($wynik==="Nieznany"){
                    $punkty2 = 0;
                    $punkty_dodane_sql = "UPDATE runda$wybrana_runda SET Punkty_Dodane = '0' WHERE ID_betu = $bet AND ID=$user_id"; 
                    mysqli_query($conn, $punkty_dodane_sql); // Jeżeli wynik jest nieznany, punkty nie mają być dodawane
                }else{
            
                $wynik_real1 = $row['Wynik_faktyczny_Team1'];
                $wynik_real2 = $row['Wynik_faktyczny_Team2'];

                
                if ($wynik1 == $wynik_real1 && $wynik2 == $wynik_real2) {
                    $punkty_dodane = true;
                    $punkty2 .= "  +4 (Wynik) ";
                    $punkty += 4; // Jeżeli wynik obstawiony jest taki sam jak wynik rzeczywisty to dodaje +4 punkty
                }
                else if ($wynik1 == $wynik2 && $wynik_real1 == $wynik_real2 && ($wynik_real1 >=0 || $wynik_real2 >= 0)) {
                    $punkty_dodane = true;
                    $punkty2 .= "  +2 (Remis) ";
                    $punkty += 2; // Jeżeli wynik obstawiony i rzeczywisty to remis + 2 punkty
                }
                else if (abs($wynik1 - $wynik2) >= 2 && abs($wynik_real1 - $wynik_real2) >= 2  && (abs($wynik1 - $wynik2) == abs($wynik_real1 - $wynik_real2)) && (($wynik1 > $wynik2 && $wynik_real1 > $wynik_real2) || ($wynik2 > $wynik1 && $wynik_real2 > $wynik_real1))&& ($wynik_real1 >= 0 && $wynik_real2 >= 0)) {
                    $punkty_dodane = true;
                    $punkty2 .= "  +2 (Różnica) ";
                    $punkty += 2; // Jeżeli różnica bramkowa rzeczywistego i obstawionego wynosi tyle samo oraz jest obstawiony za tą samą drużyną + 2 punkty
                }
                else if (($wynik1 > $wynik2 && $wynik_real1 > $wynik_real2) || ($wynik2 > $wynik1 && $wynik_real2 > $wynik_real1)) {
                    $punkty_dodane = true;
                    $punkty2 .= "  +1  (Wygrana) ";
                    $punkty +=1; // Jeżeli wynik obstawiony i rzeczywisty wskazuje na tego samego zwycięzce +1 punkt
                    
                }
                if (($team1 === "Polska" or $team2 === "Polska") && $punkty_dodane == true) {
                    $punkty_dodane = true;
                    $punkty2 .= "<br>  +1 (Reprezentacja)  ";
                    $punkty += 1; // Jeżeli jest to mecz reprezentacji i jest uznany za wygraną + 1 punkt
                }
                else if($punkty_dodane == false){
                $punkty2 ="0";
                } // Jeżeli żadne z powyższych 0 punktów
            }
                $update_punkty2 = "UPDATE wyniki SET `Runda_$wybrana_runda` = $punkty WHERE  ID = $user_id";
                $update_punkty = "UPDATE runda$wybrana_runda SET Punkty = $punkty WHERE ID = $user_id";
                    $punkty_dodane_sql = "UPDATE runda$wybrana_runda SET Punkty_Dodane = '$punkty2' WHERE ID_betu = $bet AND ID=$user_id";
                    mysqli_query($conn, $punkty_dodane_sql); // Jeżeli wynik nie jest nieznany, ma wyświetlić dodane punkty z danego spotkania
                mysqli_begin_transaction($conn); //Wykonanie 2 aktualizacji w 1 momencie

                mysqli_query($conn, $update_punkty);
                mysqli_query($conn, $update_punkty2);
                mysqli_commit($conn);
            }
                
        }
        // Aktualizacja sumy punktów w tabeli wyników dla każdego użytkownika

        $sql_leaderboard = "SELECT DISTINCT ID, Runda_1, Runda_2, Runda_3, Runda_4, Runda_5, Mistrz FROM wyniki";
        $leaderboard = mysqli_query($conn, $sql_leaderboard);
        while($row = mysqli_fetch_assoc($leaderboard)){
        $id = $row['ID'];
        $runda1 = $row['Runda_1'];
        $runda2 = $row['Runda_2'];
        $runda3 = $row['Runda_3'];
        $runda4 = $row['Runda_4'];
        $runda5 = $row['Runda_5'];
        $mistrz = $row['Mistrz'];
        if ($mistrz == $mistrz_faktyczny){
            $mistrz_add = 10;
        }else{
            $mistrz_add = 0;
        }
        $suma = $runda1+$runda2+$runda3+$runda4+$runda5+$mistrz_add;
        $update_suma = "UPDATE wyniki SET Punkty = $suma WHERE ID = $id";
        mysqli_query( $conn, $update_suma );
        }


    ?>