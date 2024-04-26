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


// Pobranie ID użytkownika z sesji lub innego źródła
 // Załóżmy, że ID użytkownika przechowywane jest w sesji
include 'data.php';
include 'database_data.php';

        echo "<span class='user-name'>".$username."</span><br><hr style='width: 110%; position: relative; left: -10px; top: -4px;'><br>";
        echo  "<span style='position: relative; top: -20px;'>".$imie." ".$nazwisko."</span>";
        // Wyświetl inne dane użytkownika

// Zamknięcie połączenia z bazą danych
$conn->close()
?>
                    <span class="logout" onclick="logout()">Wyloguj</span>
                </div>
            </div>
        </nav>
    </header>
    <article>
        <div class="container">
            <h1 style="margin: 10px 0 50px 0;">Mistrzostwa Europy w Piłce Nożnej 2024</h1>
            Mistrzostwa Europy w Piłce Nożnej 2024 to jedno z najważniejszych wydarzeń sportowych na starym
            kontynencie.<br>
            Turniej finałowy odbędzie się w Niemczech i potrwa od 14 czerwca do 14 lipca 2024 roku. W sumie zostanie
            rozegranych 51 meczów. <br>
            Oto kilka kluczowych informacji:
            <ul>
                <li>Gospodarz: Niemcy (po raz drugi, poprzednio w 1988 roku jako RFN).</li>
                <li>Stadiony: Turniej będzie rozgrywany na dziesięciu stadionach, w tym m.in. na Olympiastadion w
                    Berlinie (finał) oraz Allianz Arena w Monachium (mecz otwarcia).</li>
                <li>Losowanie grup: Odbyło się 2 grudnia 2023 roku w Hamburgu.</li>
                <li>Inauguracja: 14 czerwca w Monachium o godzinie 21:00 (spotkanie Niemcy | Szkocja). </li>
                <li>Finał: 14 lipca o 21:00 na Stadionie Olimpijskim w Berlinie.</li>
            </ul>
            Lista uczestników Mistrzostw Europy obejmuje 21 z 24 drużyn, w tym Reprezentację Polski, która
            zakwalifikowała się poprzez baraże.<br><br><br>
            <center> <span style="font-weight: bold; font-size: 22px;">Regulamin</span> </center>
            <b>Przebieg gry:</b><br>
            Gra podzielona jest na 5 etapów (faza grupowa, 1/8 finału, ćwierćfinały, półfinały i finał), przy czym etap
            nr
            1(Faza Grupowa) jest podzielony na 3 rundy. Na każdym z etapów dostajemy kartę do typowania, na której
            obstawiamy bramkowy wynik meczów (np.2:1). Po każdym z etapów zostanie wywieszona tabela wyników,
            aby gracze mogli kontrolować swoje postępy.<br><br>

            <center> <span style="font-weight: bold; font-size: 22px;">Punktacja i wyniki</span> </center>
            <b>Punktowanie meczów:</b><br>
            <ul>
                <li>Obstawienie rezultatu meczu (zwycięstwo, remis, porażka) - <b>1pkt</b></li>
                <li>Obstawienie różnicy bramkowej (np. obstawienie wyniku 3:1, przy faktycznym rezultacie 2:0 tj. dwie
                    bramki różnicy - <b>2pkt</b></li>
                <i>UWAGA! Trafiony remis zawsze daje co najmniej 2pkt, ze względu na różnicę bramkową.</i>
                <li>Obstawienie faktycznego wyniku meczu - <b>4pkt</b></li>
                <li>Za mecze reprezentacji Polski do wyniku dodawany jest <b>1pkt.</b></li>
                <li>Za prawidłowe wytypowanie Mistrza Świata w pierwszym etapie gry - <b>10pkt</b></li>
            </ul>
            <b>Wyniki:</b><br>
            <ol>
                <li>Zwycięzcą zostaje gracz z największą ilością uzyskanych punktów w przeciągu całego turnieju.</li>
                <li>W wypadku, gdy dwóch lub więcej graczy ma tyle samo punktów to priorytetowe znaczenie dla wyniku
                    zawodów mają punkty za mecze reprezentacji Polski.</li>
                <li>W wypadku, gdy dwóch lub więcej graczy ma tyle samo punktów, oraz tyle samo punktów za mecze
                    reprezentacji
                    Polski to priorytetowe znaczenie dla wyniku zawodów ma ilość poprawnie wytypowanych faktycznych
                    wyników
                    meczów.</li>
                <li>W kolejnych przypadkach o kolejności decyduje organizator zawodów.</li>
            </ol>
            <b>Wygrana:</b><br>
            Organizator zastrzega sobie prawo do podziału wygranej w zależności od ilości uczestników gry – przewidywana
            jest
            wygrana za zwycięstwo lub wygrana za trzy pierwsze miejsca.

        </div>
    </article>
    <script>
    function logout() {
        window.location.href = "logout.php";
    }
    window.addEventListener('load', function() {
        var container = document.querySelector('.container');
        // Sprawdź, czy tabela istnieje
        if (container) {

            // Ustaw wysokość sekcji <article>
            var height = container.offsetHeight;
            document.querySelector('.container').style.setProperty('--before-height', height + 75 + 'px');
        } else {
            console.error('Nie można znaleźć tego id');
        }
    });
    </script>
</body>

</html>



<?php
include 'session.php';
?>