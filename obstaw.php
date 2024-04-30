<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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
                    href="konto.php?user_id=<?php include 'session.php'; include 'data.php'; echo $user_id; ?>">Konto<span id="user-icon"
                        class="material-symbols-outlined">account_circle</span></a>
                <div class="user-info">
                    <?php
                    include 'data.php';
                    include 'database_data.php';
                    echo "<span class='user-name'>" . htmlspecialchars($username) . "</span><br><hr style='width: 107%; position: relative; left: -10px; top: -4px;'><br>";
                    echo  "<span style='position: relative; top: -20px;'>" . htmlspecialchars($imie) . " " . htmlspecialchars($nazwisko) . "</span>";
                    // Wyświetl inne dane użytkownika
                    ?>
                    <span class="logout" onclick="logout()">Wyloguj</span>
                </div>
            </div>
        </nav>
    </header>
    <article>
        <div class="container">
            <h1 style="text-align: center;">Obstaw mecz</h1>
            <br>
            <form method="POST" id="form">
                <div id="obstaw-form">

                    <?php
                    include 'dane_mistrzostwa.php'; /* Dane meczy odbywanych w danym roku Team1 vs Team2 i tak pokolei */
                    $punkty = 0;
                    $max_obstawianie_time = strtotime($data_obstawienia); // Ustawia maksymalną godzinę na dzisiaj o 15:00
                    $end_date = strtotime($data_obstawienia); // Przykładowa data, do której można obstawiać
                    $existing_bet_query = "SELECT COUNT(*) AS bet_count FROM runda$runda WHERE ID = ?";
                    $stmt = $conn->prepare($existing_bet_query);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $bet_count = $row['bet_count'];
                    $stmt->close();

                    if ($bet_count > 0) { // Wyświetlenie błędu w przypadku gdy gracz ma postawiony bet w danej rundzie.
                        echo "<span class='bet-error'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                Masz już postawiony zakład w rundzie " . htmlspecialchars($runda) . "!<br> Możesz postawić tylko jeden zakład na daną rundę.</span>"; 
                    } else {
                        if (time() < $max_obstawianie_time && time() < $end_date) { // Jeżeli data jest mniejsza niż ustawiona w dane_mistrzostwa.php, to można obstawiać
                            echo '<span class="stawka-napis">Stawka:</span> <span class="stawka">' . htmlspecialchars($stawka) . ' zł</span>'; // Wyświetlana stawka na stronie
                            echo '<div style="position: relative; left: 485px; top: -25px;"><span class="stawka-napis" style="margin-top: 20px; font-size: 25px;">Runda:</span> <span class="stawka" style="margin-top: 20px; font-size: 25px;">' . htmlspecialchars($runda) . '</span></div>';

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $currentdate = date('H:i ') . "       " . date('d-m-Y');
                                $stmt = $conn->prepare("INSERT INTO runda$runda (ID_betu, ID, Team_1, Team_2, `Data`) VALUES (?, ?, ?, ?, ?)"); //Wprowadzanie do bazy danych użytkownika
                                $stmt->bind_param("iisss", $key, $user_id, $team1, $team2, $currentdate); // Zabezpieczenie przed SQL INJECTION

                                foreach ($mecze as $key => $mecz) {
                                    $team1 = $mecz['Team1'];
                                    $team2 = $mecz['Team2'];
                                    $stmt->execute();
                                }
                                $stmt->close();

                                if ($runda == 1){
                                    $stmt = $conn->prepare("INSERT INTO wyniki (ID, Imie, Nazwisko) VALUES (?, ?, ?)"); //Po wprowadzeniu danych w 1 rundzie, dodaje użytkownika do bazy
                                    $stmt->bind_param("iss", $user_id, $imie, $nazwisko); // o nazwie "wyniki", która odpowiada za skrócone dane, dotyczące punktów w danych rundach
                                    $stmt->execute(); // od użytkowników.
                                    $stmt->close();
                                }

                                $wyniki = $_POST['Wynik'];
                                $mecz_id = 0;
                                $stmt = $conn->prepare("UPDATE runda$runda SET Wynik_Typowany_Team1 = ?, Wynik_Typowany_Team2 = ? WHERE ID_betu = ? AND ID = ?");
                                $stmt->bind_param("iiii", $wynik1, $wynik2, $mecz_id, $user_id); // Aktualizacja wyników, które użytkownik typuje

                                foreach ($wyniki as $key => $wynik) {
                                    $wynik1 = $wynik[1];
                                    $wynik2 = $wynik[2];
                                    $mecz_id++;
                                    $stmt->execute();
                                }
                                $stmt->close();

                                if ($runda == 1){
                                    $mistrz = $_POST['mistrz'];
                                    $update_query = "UPDATE runda$runda SET Wytypowany_Mistrz = ? WHERE ID_betu BETWEEN 1 AND 40 AND ID = ?";
                                    $stmt = $conn->prepare($update_query);
                                    $stmt->bind_param("si", $mistrz, $user_id); //Aktualizacja wytypowanego mistrza w bazie
                                    $stmt->execute();
                                    $stmt->close();
                                }

                            }

                            if ($runda !== 1) {
                            } else {
                                $addedTeams = array();
                                echo '<span name="trophy1" class="material-symbols-outlined">
                                    trophy
                                    </span><select class="mistrz" name="mistrz">';
                                echo '<option selected>Wybierz mistrza</option>';
                                foreach ($mecze as $id => $mecz) { //Wybór mistrza na stronie, w przypadku rundy 1
                                    $team1 = $mecz['Team1'];
                                    $team2 = $mecz['Team2'];
                                    if (!in_array($team1, $addedTeams)) {
                                        echo '<option value="' . htmlspecialchars($team1) . '">' . htmlspecialchars($team1) . '</option>';
                                        $addedTeams[] = $team1; // Dodajemy drużynę do tablicy dodanych drużyn, aby się nie powtarzała
                                    }
                                    
                                    if (!in_array($team2, $addedTeams)) {
                                        echo '<option value="' . htmlspecialchars($team2) . '">' . htmlspecialchars($team2) . '</option>';
                                        $addedTeams[] = $team2; // Dodajemy drużynę do tablicy dodanych drużyn
                                    } 
                                }
                                echo '</select><span name="trophy2" class="material-symbols-outlined">
                                    trophy
                                    </span>';
                            }
                            $meczId = 1;
                            foreach ($mecze as $id => $mecz) {
                                $team1 = $mecz['Team1'];
                                $team2 = $mecz['Team2'];

                                echo '<div class="spotkania"><span class="mecz">' . htmlspecialchars($team1) . '</span></div><div class="vs-div"> <span class="vs">VS</span></div><div class="spotkania2"> <span class="mecz">' . htmlspecialchars($team2) . '</span></div><hr class="line">';
                                echo '<input type="number" class="Wynik" id="Wynik-1" name="Wynik[' . htmlspecialchars($id) . '][1]" placeholder="Wynik ' . htmlspecialchars($team1) . '" required><br><hr class="hr-wynik">';
                                echo '<input type="number" class="Wynik" id="Wynik-2" name="Wynik[' . htmlspecialchars($id) . '][2]" placeholder="Wynik ' . htmlspecialchars($team2) . '" required><br>';
                            } // Wyświetlanie spotkania i miejsca do obstawienia wyniku - użytkownik musi wprowadzić wszystkie wyniki ze wszystkich spotkań, bo strona go nie przepuści dalej.
                            echo '<input type="submit" value="Obstaw">';
                        } else {
                            echo "<span class='bet-time'>Obstawianie meczy jest już zamknięte.</span>";
                        }
                        
                    }
                    ?>
                    
                </div>
            </form>
        </div>
    </article>

    <script>
    function logout() {
        window.location.href = "logout.php";
    }
    window.addEventListener('load', function() {
        var obstaw = document.getElementById('obstaw-form');
        // Sprawdź, czy tabela istnieje
        if (obstaw) {

            // Ustaw wysokość sekcji <article>
            var height = obstaw.offsetHeight;
            document.querySelector('.container').style.setProperty('--before-height', height + 250 + 'px');
        } else {
            console.error('Nie można znaleźć tabeli o id "tabela"');
        }
    });
    </script>
</body>

</html>
<?php
// Sprawdź, czy dane z formularza zostały przesłane
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database_data.php';
    include 'data.php';
    include 'session.php';

    // Zamknięcie połączenia z bazą danych
    $conn->close();
}
?>
