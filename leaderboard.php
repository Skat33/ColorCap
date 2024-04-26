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
            include 'dane_mistrzostwa.php';
            include 'punkty.php';


// Aktualizuj punkty użytkowników
            $sql = "SELECT DISTINCT `ID`, `Imie`, `Nazwisko`, `Runda_1` AS `Runda 1`, `Runda_2` AS `Runda 2`, `Runda_3` AS `Runda 3`, `Runda_4` AS `Runda 4`, `Runda_5` AS `Runda 5`, `Punkty` FROM wyniki
            ORDER BY wyniki.Punkty DESC LIMIT 10";
    $result = mysqli_query($conn, $sql);
    $columns = $result->fetch_fields();
    echo '<table id="tabela" border="2" cellspacing="0" >';
        foreach ($columns as $column){
            if ($column->name == 'ID'){
                echo '<th style="background-color: #111;">Miejsce</th>';
            }else{
            echo '<th style="background-color: #111;">'.$column->name.'</th>';
            }
        }
        echo '<tr></tr>';
    $i=1;
    mysqli_data_seek($result, 0);
    $suma = 0;
    while ($row = mysqli_fetch_assoc($result)){
        $id = $row['ID'];
        $runda1 = $row['Runda 1'];
        $runda2 = $row['Runda 2'];
        $runda3 = $row['Runda 3'];
        $runda4 = $row['Runda 4'];
        $runda5 = $row['Runda 5'];
        $suma = $runda1+$runda2+$runda3+$runda4+$runda5;
        $update_suma = "UPDATE wyniki SET Punkty = $suma WHERE ID = $id";
        mysqli_query( $conn, $update_suma );    
        echo '<tr>';
        foreach ($row as $key => $value){
            if ($key === "ID"){
                echo '<td style="color: yellow; font-size: 20px;">'.$i.'</td>';
            }else{
            echo '<td>'.$value.'</td>';
            }
            
        }
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