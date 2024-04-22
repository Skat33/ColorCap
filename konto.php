<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
 
         echo "<span class='user-name'>".$username."</span><br><hr style='width: 110%; position: relative; left: -10px; top: -4px;'><br>";
         echo  "<span style='position: relative; top: -20px;'>".$imie." ".$nazwisko."</span>";
         // Wyświetl inne dane użytkownika
 


// Pobierz identyfikator użytkownika z sesji

// Sprawdź, czy parametr user_id został przekazany w adresie URL
if (isset($_GET['user_id'])) {
    // Jeśli parametr user_id został przekazany, sprawdź, czy jest to identyfikator bieżącego użytkownika
    if ($_GET['user_id'] != $user_id) {
        // Jeśli parametr user_id nie zgadza się z identyfikatorem bieżącego użytkownika, przekieruj użytkownika na stronę błędu lub inny adres URL
        header("Location: konto.php?user_id=$user_id");
        exit();
    }
   }
$conn->close()
?>
                    <span class="logout" onclick="logout()">Wyloguj</span>
                </div>
            </div>
        </nav>
    </header>
    <article>
        <div class="container">

            <h1>Account Details</h1>
            <hr style="top: 10px;">
            <img src="user.jpg" alt="user" width="175px" height="200px" class="user-img">
            <span class="nick"><?php include 'database_data.php'; echo $username; ?></span>
            <span class="user-rank">User</span>
            Tu będą dane użytkownika
        </div>
    </article>
    <script>
    function logout() {
        window.location.href = "logout.php";
    }
    </script>
</body>

</html>