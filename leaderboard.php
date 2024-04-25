<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
            <h1 style="margin-top: 20px;">Top 10</h1>
            <?php
            include "session.php";
            $sql = "SELECT DISTINCT users.ID, users.Imie, users.Nazwisko, bet.Punkty, bet.Data FROM users INNER JOIN bet ON users.ID = bet.ID 
            ORDER BY bet.Punkty DESC LIMIT 10";
    $result = mysqli_query($conn, $sql);
    $columns = $result->fetch_fields();
    echo '<table id="tabela" border="2" cellspacing="0" >';
        foreach ($columns as $column){
            if ($column->name == 'ID'){
                echo '<th>Miejsce</th>';
            }else{
            echo '<th>'.$column->name.'</th>';
            }
        }
        echo '<tr></tr>';
    $i=1;
    mysqli_data_seek($result, 0);
    while ($row = mysqli_fetch_assoc($result)){
        echo '<tr>';
        echo '<td>'.$i.'</td>';
        echo '<td>'.$row['Imie'].'</td>';
        echo '<td>'.$row['Nazwisko'].'</td>';
        echo '<td>'.$row['Punkty'].'</td>';
        echo '<td>'.$row['Data'].'</td>';
        echo '</tr>';
        $i++;
    }
    echo '</table>';
            ?>
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