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

                    echo "<span class='user-name'>" . $username . "</span><br><hr style='width: 110%; position: relative; left: -10px; top: -4px;'><br>";
                    echo  "<span style='position: relative; top: -20px;'>" . $imie . " " . $nazwisko . "</span>";
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

            echo '<table>';
            if ($username === $admin) {
                $sql_specified = "SELECT * from users";
                $result_specified = mysqli_query($conn, $sql_specified);
                echo '<form id="userForm" class="user-search">
                <select id="userSelect" name="users">
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

            include 'punkty.php'; // W tym miejscu dochodzi do aktualizacji punktów przed wyświetleniem samej tabeli. W przypadku zmiany danych w dane_mistrzostwa.php 
            // Dane się automatycznie zaktualizują, więc po odświeżeniu strony dostaniemy nowe aktualne dane


            // Aktualizacja punktów tylko raz po obliczeniu punktów dla wszystkich rekordów
            echo '<form id="RoundsForm" onsubmit="return submitRounds()">
    <select id="select-rounds" name="selected-rounds" onchange="submitRounds()"'; if($username !== $admin){ 
        echo 'style="position: relative; top: 85px; left: 860px; width: 155px;">';
    }else{echo 'style="position: relative; top: 72.5px; left: 575px; width: 155px;">';}
    echo '<option selected>Wybierz rundę</option>';
            for ($i = 1; $i <= 5; $i++) {
                echo '<option value="' . $i . '">Runda ' . $i . '</option>';
            }
            echo '</select></form>';
            echo '<span class=';if($username!==$admin){echo '"runda"';} else {
                echo '"rundaif';
            }echo '>Runda: </span><span class=';if($username!==$admin){echo '"runda"';} else {
                echo '"rundaif';
            }echo ' style="color: white;">'.$wybrana_runda.'</span>';
            if (isset($_GET['selected-rounds'])) {
                $wybrana_runda = $_GET['selected-rounds'];
            } else {
                $wybrana_runda = $runda;
            }
            $query = "SELECT `Data` FROM runda$wybrana_runda WHERE ID=$id_user";
            $result2 = mysqli_query($conn, $query);
            $row2 = mysqli_fetch_array($result2);
            if (mysqli_num_rows($result2) == 0) {
                echo "";
            } else {
                $data = $row2['Data'];
                $wytypowany_mistrz = "SELECT * FROM runda1 WHERE ID = $id_user";
                $wytypowany_result = mysqli_query($conn, $wytypowany_mistrz);
                $row_mistrz = mysqli_fetch_assoc($wytypowany_result);
                $mistrz = $row_mistrz['Wytypowany_Mistrz'];
            }
            $sql = "SELECT `ID_betu` AS `Numer meczu`, `Team_1` AS `Drużyna Pierwsza`, `Team_2` AS `Drużyna Druga`, `Wynik`, `Wynik_Typowany` AS `Wynik Obstawiony`, `Punkty_Dodane` AS `Punkty Zdobyte`, `Punkty` FROM runda$wybrana_runda WHERE ID = $id_user";


            $wynik = "SELECT * FROM runda$wybrana_runda WHERE ID = $id_user";
            $wynik_result = mysqli_query($conn, $wynik);

            while ($row = mysqli_fetch_assoc($wynik_result)) {
                $id_betu = $row['ID_betu'];
                if ($row['Wynik_faktyczny_Team1'] < 0 or $row['Wynik_faktyczny_Team2'] < 0){
                    $wynik_faktyczny = "Nieznany";
                }else{
                $wynik_faktyczny = $row['Wynik_faktyczny_Team1'] . " - " . $row['Wynik_faktyczny_Team2'];
                }
                $wynik_typowany = $row['Wynik_Typowany_Team1'] . " - " . $row['Wynik_Typowany_Team2'];
                $zdobyte_punkty = $row['Punkty'];

                // Połączenie danych i aktualizacja kolumny Wynik
                $update_wynik = "UPDATE runda$wybrana_runda SET Wynik = '$wynik_faktyczny', Wynik_Typowany = '$wynik_typowany' WHERE ID_betu = $id_betu AND ID = $id_user";
                mysqli_query($conn, $update_wynik);
            }
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            echo '<h2 style="text-align: center; color:orange; position: relative; top: -55px;'; if($username!==$admin){ echo 'position: relative; top: -40px;"';} echo'  ">' . $user_name . '  ' . $user_surname . ' - ID(' . $id_user . ')</h2>';
            if (mysqli_num_rows($result) == 0) {
                echo '<p class="error">Nieprawidłowe dane lub pusta baza danych!</p>';
            } else {
                if ($username === $admin) {

                    echo '
            <form method="POST" class="edit">
                <input type="submit" name="Delete-submit" value="Usuń">
            </form>';
                    if (isset($_POST['Delete-submit'])){
                        $delete = "DELETE FROM runda$wybrana_runda WHERE ID = $id_user";
                        mysqli_query($conn, $delete);   
                        header("Location: tabela.php?users=$id_user&selected-rounds=$wybrana_runda");
                        $update_punkty = "UPDATE runda$wybrana_runda SET Punkty = 0 WHERE ID = $id_user";
                        mysqli_query($conn, $update_punkty);
                        $update_punkty2 = "UPDATE wyniki SET `Runda_$wybrana_runda` = 0 WHERE  ID = $id_user";
                        mysqli_query($conn, $update_punkty2);
                    }
                }
                $columns = $result->fetch_fields();
                echo '<table id="tabela"'; if($username!==$admin){  echo 'style="position: relative; top: 15px;"';} else{ echo 'style="position: relative; top: -30px;"';}
                 echo 'class="bety" border="2" cellspacing="0">';
                // Wyświetlenie nazw kolumn
                echo '<tr>';
                foreach ($columns as $column) {
                    if ($column->name == 'Punkty'){
                        continue;
                    }else{
                    echo '<th style="background-color: #111;">' . $column->name . "</th>";
                    }
                }
                echo '</tr>';
                // Wyświetlanie danych
                mysqli_data_seek($result, 0);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    foreach ($row as $key => $value) {
                        if($key === 'Punkty'){
                            continue;
                        }else{
                        echo '<td>' . $value . '</td>';
                        }
                    }
                    echo '</tr>';
                }
                if ($mistrz == $mistrz_faktyczny) {
                    echo '<tr>
                    <td colspan="6" style="text-align: center; color: black; background-color: orange; height: 15px;">
                        Potencjalny Wygrany Turnieju: <span
                            style="font-weight: bold; color: darkred; text-decoration: underline;">' . $mistrz . '</span> (+10)
                    </td>
                
                </tr>';
                } else {
                    echo '<tr>
                    <td colspan="6" style="text-align: center; color: black; background-color: orange; height: 15px;">
                        Potencjalny Wygrany Turnieju: <span
                            style="font-weight: bold; color: darkred; text-decoration: underline;">' . $mistrz . '</span>
                    </td>
                
                </tr>';
                }
                echo '<tr>
                    <td colspan="5" style="text-align: right; height: 15px;"><span style="margin-right: 10px">Zdobyte
                            punkty</span> </td>' . '<td style="height: 15px;">' . $zdobyte_punkty . '</td>
                </tr>';
                echo '<tr>
                    <td colspan="5" style="text-align: right; height: 15px;"><span style="margin-right: 10px">Data
                            obstawienia</span> </td>' . '<td style="height: 15px;">' . $data . '</td>
                </tr>';
                echo '</table>';

            }

            ?>
        </div>
    </article>
    <script>
        function logout() {
            window.location.href = "logout.php";
        }

        window.addEventListener('load', function () {
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
    function submitRounds(){
        var form = document.getElementById('RoundsForm');
        form.submit();
    }
    var currentUser = '<?php echo isset($_GET['users']) ? $_GET['users'] : $id_user; ?>';
    var currentRound = '<?php echo isset($_GET['selected-rounds']) ? $_GET['selected-rounds'] : $runda; ?>';

    // Funkcja wywoływana przy zmianie wybranej rundy
    document.getElementById('select-rounds').addEventListener('change', function () {
        var selectedRound = this.value;
        var selectedUser = currentUser; // Użyj aktualnej wartości selecta użytkownika
        window.location.href = 'tabela.php?users=' + selectedUser + '&selected-rounds=' + selectedRound;
    });

    // Funkcja wywoływana przy zmianie wybranego użytkownika
    document.getElementById('userSelect').addEventListener('change', function () {
        var selectedUser = this.value;
        var selectedRound = currentRound; // Użyj aktualnej wartości selecta rundy
        window.location.href = 'tabela.php?users=' + selectedUser + '&selected-rounds=' + selectedRound;
    });
    </script>
</body>

</html>
