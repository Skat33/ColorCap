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
            <a href="leaderboard.php">Leaderboard</a>
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

               
               foreach ($wynikiRzeczywiste as $id_meczu => $wynik) {
                $wynik_faktyczny = $wynik['Wynik1'] . ' - ' . $wynik['Wynik2'];
                $update_query = "UPDATE bet SET Wynik_faktyczny_Team1 = '{$wynik['Wynik1']}', Wynik_faktyczny_Team2 = '{$wynik['Wynik2']}' WHERE ID_betu = $id_meczu";
                mysqli_query($conn, $update_query);
            }


               echo '<table>';    
               if ($username === "Skat33"){
                $sql_specified = "SELECT * from users";
                $result_specified = mysqli_query($conn, $sql_specified);
                echo '<form id="userForm" class="user-search" onsubmit="return submitForm()">
                <select id="userSelect" name="users" onchange="submitForm()">
                <option selected>Wybierz użytkownika</option>';
                    while ($row = mysqli_fetch_assoc($result_specified)) {
                        $user_name = $row['Imie'];
                        $user_surname = $row['Nazwisko'];
                        $id = $row['ID'];
                        echo '<option value="' . $id . '">' . $user_name . '    ' . $user_surname . '</option>';
                    }
    echo '</select>
    </form>';
    }
    if (isset($_GET['users'])){
    $id_user = $_GET['users'];
    $dane = "SELECT * FROM users WHERE ID = $id_user";
    $dane_result = mysqli_query($conn, $dane);
    $row_dane = mysqli_fetch_assoc($dane_result);
    $user_name = $row_dane['Imie'];
    $user_surname = $row_dane['Nazwisko'];
    }
    else{
        $id_user = $user_id;
        $user_name = $imie;
        $user_surname = $nazwisko;
    }
    if ($username !== "Skat33"){
        $id_user = $user_id;
        $user_name = $imie;
        $user_surname = $nazwisko;
    }
    $sql_punkty = "SELECT * FROM bet WHERE ID = $id_user";
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
    

    // Aktualizacja punktów tylko raz po obliczeniu punktów dla wszystkich rekordów
    $punkty_update = "UPDATE bet SET Punkty = $punkty WHERE ID = $id_user";
    $punkty_result = mysqli_query($conn, $punkty_update);
    $query = "SELECT `Data`, `Wytypowany_Mistrz`, `Wynik_faktyczny_Team1` FROM bet WHERE ID=$id_user";
    $result2 = mysqli_query($conn, $query);
    $row2 = mysqli_fetch_array($result2);
    if (mysqli_num_rows($result2)==0){
        echo "";
    }else{
    $data = $row2['Data']; 
    $mistrz = $row2['Wytypowany_Mistrz'];
    }
    $sql = "SELECT `ID_betu` AS `Numer meczu`, `Team_1` AS `Drużyna Pierwsza`, `Team_2` AS `Drużyna Druga`, `Wynik`, `Wynik_Typowany` AS `Wynik Obstawiony`, `Punkty_Dodane` AS `Punkty` FROM bet WHERE ID = $id_user";
              
            $wynik = "SELECT * FROM bet WHERE ID = $id_user";
            $wynik_result = mysqli_query($conn, $wynik);  
            
            while ($row = mysqli_fetch_assoc($wynik_result)) {
            $id_betu = $row['ID_betu'];
             $wynik_faktyczny = $row['Wynik_faktyczny_Team1'] . " - " . $row['Wynik_faktyczny_Team2'];
             $wynik_typowany = $row['Wynik_Typowany_Team1'] . " - " . $row['Wynik_Typowany_Team2'];
             $zdobyte_punkty = $row['Punkty'];
             $rekord_dodany = false;
         
             // Połączenie danych i aktualizacja kolumny Wynik
             $update_wynik = "UPDATE bet SET Wynik = '$wynik_faktyczny', Wynik_Typowany = '$wynik_typowany' WHERE ID_betu = $id_betu AND ID = $id_user";
             mysqli_query($conn, $update_wynik);
             $rekord_dodany = true;
         }    
               $result = mysqli_query($conn, $sql);
               $row = mysqli_fetch_assoc($result);
               echo '<h2 style="text-align: center; color:orange;">'.$user_name.'  '.$user_surname.' - ID('.$id_user.')</h2>';
               if(mysqli_num_rows($result) == 0){
                  echo '<p class="error">Nieprawidłowe dane lub pusta baza danych!</p>';
               } else {
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
                mysqli_data_seek($result, 0);

                while($row = mysqli_fetch_assoc($result)){
                echo '<tr>';
                    foreach ($row as $key => $value){
                    echo '<td>'.$value.'</td>';
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