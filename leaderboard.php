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

$suma = 0;

            $sql = "SELECT DISTINCT `ID`, `Imie`, `Nazwisko`, `Runda_1` AS `Runda 1`, `Runda_2` AS `Runda 2`, `Runda_3` AS `Runda 3`, `Runda_4` AS `Runda 4`, `Runda_5` AS `Runda 5`, `Mistrz`, `Punkty` FROM wyniki
            ORDER BY wyniki.Punkty DESC LIMIT 10";
                $sql_users = "SELECT DISTINCT ID FROM runda1";
                $query_users = mysqli_query($conn, $sql_users);
                
                while ($row_user = mysqli_fetch_assoc($query_users)) {
                    $user_id = $row_user['ID'];
                
                    // Pobierz zakłady dla danego użytkownika
                    $sql_bets = "SELECT * FROM runda1 WHERE ID = $user_id";
                    $query_bets = mysqli_query($conn, $sql_bets);
                
                    // Zainicjuj zmienne punktów dla danego użytkownika
                    $wytypowany_mistrz = "SELECT * FROM runda1 WHERE ID = $user_id";
                    $wytypowany_result = mysqli_query($conn, $wytypowany_mistrz);
                    $sql2 = "SELECT DISTINCT ID, Wytypowany_Mistrz FROM runda1 WHERE ID = $user_id";
                    $result2 = mysqli_query($conn, $sql2);
                    while ($row2 = mysqli_fetch_array($result2)) {
                         $mistrz = $row2['Wytypowany_Mistrz'];
                         $mistrz_sql = "UPDATE wyniki SET Mistrz = '$mistrz' WHERE ID = $user_id";
                         mysqli_query( $conn, $mistrz_sql); 
                    }
                }            

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
    while ($row = mysqli_fetch_assoc($result)){    
        echo '<tr>';
        foreach ($row as $key => $value){
            if ($key === "ID"){
                echo '<td style="color: yellow; font-size: 20px;">'.$i.'</td>';
            }else if ($key === "Punkty"){
                echo '<td style="color: yellow; font-size: 20px;">'.$value.'</td>';
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