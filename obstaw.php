<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Colorcap</title>
</head>
<body>
    <header class="header">
        <h1 class="logo"><a href="#"><i>Constantia<span class="logo2">Colorcap</span></i></a></h1>
        <nav class="main-nav">
            <a href="index.php">Home</a>
            <a href="tabela.php">Tabela</a>
            <a href="obstaw.php">Obstaw</a>
            <div class="konto">
                <a class="konto2" tabindex="0" href="konto.php?user_id=<?php include 'data.php'; echo $user_id; ?>">Konto<span id="user-icon" class="material-symbols-outlined">account_circle</span></a>
                <div class="user-info">
                    <?php
                    include 'data.php';
                    include 'database_data.php';
                    echo "<span class='user-name'>".$username."</span><br><hr style='width: 107%; position: relative; left: -10px; top: -4px;'><br>";
                    echo  "<span style='position: relative; top: -20px;'>".$imie." ".$nazwisko."</span>";
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
                    <input type="number" name="stawka" placeholder="Stawka" required>
                    <label for="stawka"> zł</label><br>

                    <?php
                    $mecze = array(
                        1 => array("Team1" => "Czechy", "Team2" => "Belgia"),
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
                        13 => array("Team1" => "Ukraina", "Team2" => "Gruzja")
                    );  if ($_SERVER["REQUEST_METHOD"] == "POST") {
                           $wyniki = $_POST['Wynik'];
                           foreach ($wyniki as $wynik){
                              $sql2 = "UPDATE bet SET Wynik_typowany = '$wynik' WHERE ID = '$user_id'";
                              $conn->query($sql2);
                           }
                       }
                    foreach ($mecze as $id => $mecz) {
                   

                        // Pobierz dane drużyn i pozostałe wartości meczu
                        $team1 = $mecz['Team1'];
                        $team2 = $mecz['Team2'];

                        // Zapisz dane do bazy danych
 
                        $sql = "INSERT INTO bet (ID, Team_1, Team_2, Wynik_faktyczny) VALUES ('$user_id', '$team1', '$team2', '')";
                        if ($conn->query($sql) === TRUE) {
                        } else {
                            echo "Błąd: " . $sql . "<br>" . $conn->error;
                        }
                                             // Wyświetlenie formularza obstawiania
                        echo '<div class="spotkania"><span class="mecz">' . $team1 . '</span></div><div class="vs-div"> <span class="vs">VS</span></div><div class="spotkania2"> <span class="mecz">' . $team2 . '</span></div><hr class="line">';
                        echo '<select name="Spotkanie[]">';
                        echo '<option value="' . $team1. '">' . $team1 . '</option>';
                        echo '<option value="' . $team2 . '">' . $team2 . '</option>';
                        echo '<option value="remis">Remis</option>';
                        echo '</select><input type="text" name="Wynik[]" placeholder="Obstaw wynik"><br>';
                        reset($mecze);
                    }
                    ?>
                    <input type="submit" value="Obstaw">
                </div>
            </form>
        </div>
    </article>
    <script>
        function logout() {
            window.location.href = "logout.php";
        }
    </script>
</body>
</html>
<?php
// Sprawdź, czy dane z formularza zostały przesłane
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   include 'database_data.php';
   include 'data.php';

   // Zamknięcie połączenia z bazą danych
   $conn->close();
}
?>