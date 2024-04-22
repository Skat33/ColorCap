<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Colorcap</title>
    <style>
    .container::before {
        height: var(--before-height);
    }
    </style>
</head>

<body>
    <header class="header">
        <h1 class="logo"><a href="#"><i>Constantia<span class="logo2">Colorcap</span></i></a></h1>
        <nav class="main-nav">
            <a href="index.php">Home</a>
            <a href="tabela.php">Tabela</a>
            <a href="obstaw.php">Obstaw</a>
            <div class="konto">
                <a class="konto2" tabindex="0"
                    href="konto.php?user_id=<?php include 'data.php'; echo $user_id; ?>">Konto<span id="user-icon"
                        class="material-symbols-outlined">account_circle</span></a>

                <div class="user-info">
                    <?php
// Połączenie z bazą danych (załóżmy, że używamy MySQL)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

// Tworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pobranie ID użytkownika z sesji lub innego źródła
 // Załóżmy, że ID użytkownika przechowywane jest w sesji
include 'data.php';
include 'database_data.php';
include 'dane_mistrzostwa.php';

        echo "<span class='user-name'>".$username."</span><br><hr style='width: 110%; position: relative; left: -10px; top: -4px;'><br>";
        echo  "<span style='position: relative; top: -20px;'>".$imie." ".$nazwisko."</span>";
        // Wyświetl inne dane użytkownika

// Zamknięcie połączenia z bazą danych

?>
                    <span class="logout" onclick="logout()">Wyloguj</span>
                </div>
            </div>
        </nav>
    </header>
    <article>
        <div class="container">
            <h1 style="margin: 10px 0 40px 0;">Zakłady Mistrzostw Europy 2024</h1>
            <?php
               include 'data.php';
               $sql_punkty = "SELECT * FROM bet WHERE ID = $user_id";
               $query_punkty = mysqli_query($conn, $sql_punkty);
               $punkty = 0; // Zainicjuj zmienną punktów przed pętlą 
               
               while ($row = mysqli_fetch_assoc($query_punkty)) {
                   
                   $wynik1 = $row['Wynik_Typowany_Team1'];
                   $wynik2 = $row['Wynik_Typowany_Team2'];
                   $punkty2="";
                   $punkty_dodane = false;
                   $bet = $row['ID_betu'];
                   if ($punkty_dodane == true) {
                        
                       break;
                   }
               
                   $wynik_real1 = $row['Wynik_faktyczny_Team1'];
                   $wynik_real2 = $row['Wynik_faktyczny_Team2'];

                   
                   if ($wynik1 == $wynik_real1 && $wynik2 == $wynik_real2) {
                       $punkty_dodane = true;
                       $punkty2 .= "  +4  ";
                       $punkty += 4;
                   }
                   if ($wynik1 == $wynik2 && $wynik_real1 == $wynik_real2) {
                       $punkty_dodane = true;
                       $punkty2 .= "  +2  ";
                       $punkty += 2;
                   }
                   if (abs($wynik1 - $wynik2) >= 2 && abs($wynik_real1 - $wynik_real2) >= 2 && abs($wynik1 - $wynik2) == abs($wynik_real1 - $wynik_real2) && (($wynik1 > $wynik2 && $wynik_real1 > $wynik_real2) || ($wynik2 > $wynik1 && $wynik_real2 > $wynik_real1))) {
                       $punkty_dodane = true;
                       $punkty2 .= "  +2  ";
                       $punkty += 2;
                   }
                   if (($wynik1 > $wynik2 && $wynik_real1 > $wynik_real2) || ($wynik2 > $wynik1 && $wynik_real2 > $wynik_real1)) {
                       $punkty_dodane = true;
                       $punkty2 .= "  +1  ";
                       $punkty +=1;
                       
                   } 
                   else if($punkty_dodane == false){
                    $punkty2 ="0";
                   }
                   
                   $punkty_dodane_sql = "UPDATE bet SET Punkty_Dodane = '$punkty2 ' WHERE ID_betu = $bet AND ID=$id_user";
                   mysqli_query($conn, $punkty_dodane_sql);
               }
               $wynik = "SELECT * FROM bet WHERE ID = $user_id";
               $wynik_result = mysqli_query($conn, $wynik);
               
               $id_betu = 1;
               while ($row = mysqli_fetch_assoc($wynik_result)) {
                $wynik_faktyczny = $row['Wynik_faktyczny_Team1'] . " - " . $row['Wynik_faktyczny_Team2'];
                $wynik_typowany = $row['Wynik_Typowany_Team1'] . " - " . $row['Wynik_Typowany_Team2'];
                $zdobyte_punkty = $row['Punkty'];
                $rekord_dodany = false;
                if ($rekord_dodany){
                    break;
                } 
            
                // Połączenie danych i aktualizacja kolumny Wynik
                $update_wynik = "UPDATE bet SET Wynik = '$wynik_faktyczny', Wynik_Typowany = '$wynik_typowany' WHERE ID_betu = $id_betu AND ID = $user_id";
                mysqli_query($conn, $update_wynik);
                $rekord_dodany = true;
               $id_betu++;
            }
               // Aktualizacja punktów tylko raz po obliczeniu punktów dla wszystkich rekordów
               $punkty_update = "UPDATE bet SET Punkty = $punkty WHERE ID = $user_id";
               $punkty_result = mysqli_query($conn, $punkty_update);

               
               
               $query = "SELECT `Data`, `Wytypowany_Mistrz`, `Wynik_faktyczny_Team1` FROM bet WHERE ID=$user_id";
               $result2 = mysqli_query($conn, $query);
               $row2 = $result2->fetch_assoc();
               $data = $row2['Data']; 
               $mistrz = $row2['Wytypowany_Mistrz'];

               echo '<table>';                
               $result = mysqli_query($conn, $sql);
               $row = mysqli_fetch_assoc($result);
               echo '<h2 style="text-align: center; color:orange;">'.$imie.'  '.$nazwisko.' - ID('.$id_user.')</h2>';
               if(mysqli_num_rows($result) == 0){
                  echo '<p class="error">Nieprawidłowe dane lub pusta baza danych!</p>';
               } else {
                    $liczba = "SELECT * FROM users";
                    $liczba_result = mysqli_query($conn, $liczba); 
                  if ($username === "Skat33"){
                    
            echo '<form method="POST" class="edit" action="modify.php">
                <input type="submit" name="Modify-submit" value="Modyfikuj">
            </form>
            <form method="POST" class="edit" action="delete.php">
                <input type="submit" name="Delete-submit" value="Usuń">
            </form>';

            }
            $columns = $result->fetch_fields();
            echo '<table id="tabela" class="bety" border="2" cellspacing="0">';
                // Wyświetlenie nazw kolumn
                echo '<tr>';
                    foreach ($columns as $column) {
                    echo '<th>'.$column->name . "</th>";
                    }
                    echo '</tr>';
                // Wyświetlanie danych
                while($row = mysqli_fetch_assoc($result)){
                echo '<tr>';
                    foreach ($row as $kolumna){
                    echo '<td>'.$kolumna.'</td>';
                    }
                    echo '</tr>';
                }
                echo '<tr>
                    <td colspan="6" style="text-align: center; color: black; background-color: orange; height: 15px;">
                        Potencjalny Wygrany Turnieju: <span
                            style="font-weight: bold; color: darkred; text-decoration: underline;">'.$mistrz.'</span>
                    </td>
                </tr>';
                echo '<tr>
                    <td colspan="5" style="text-align: right; height: 15px;"><span style="margin-right: 10px">Zdobyte
                            punkty</span> </td>'.'<td style="height: 15px;">'.$zdobyte_punkty.'</td>
                </tr>';
                echo '<tr>
                    <td colspan="5" style="text-align: right; height: 15px;"><span style="margin-right: 10px">Data
                            obstawienia</span> </td>'.'<td style="height: 15px;">'.$data.'</td>
                </tr>';
                echo '</table>';
            }




            ?>
        </div>
    </article>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function logout() {
        window.location.href = "logout.php";
    }
    window.addEventListener('load', function() {
        var table = document.getElementById('tabela');
        // Sprawdź, czy tabela istnieje
        if (table) {

            // Ustaw wysokość sekcji <article>
            var tableHeight = table.offsetHeight;
            document.querySelector('.container').style.setProperty('--before-height', tableHeight + 300 + 'px');
        } else {
            console.error('Nie można znaleźć tabeli o id "tabela"');
        }
    });

    function submitForm() {
        var form = document.getElementById('userForm');
        form.submit();
    };
    </script>
</body>

</html>



<?php

include 'database_data.php';
include 'session.php';
include 'data.php';
$conn->close();
?>