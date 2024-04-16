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

    // Teraz masz nazwę użytkownika, którą możesz wykorzystać w pliku index.php

// Zapytanie SQL, aby pobrać dane użytkownika na podstawie jego ID
$sql = "SELECT imie, nazwisko, username FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Wyświetlenie danych użytkownika
    while($row = $result->fetch_assoc()) {
        echo "<span class='user-name'>".$row['username']."</span><br><hr style='width: 110%; position: relative; left: -10px; top: -4px;'><br>";
        echo  "<span style='position: relative; top: -20px;'>".$row["imie"]." ".$row["nazwisko"]."</span>";
        // Wyświetl inne dane użytkownika
    }
} else {
    echo "Brak danych użytkownika";
}

// Zamknięcie połączenia z bazą danych
$conn->close()
?>
    <span class="logout" onclick="logout()">Wyloguj</span>
            </div>
</div>
        </nav>
    </header> 
    <article>
        <!-- Tutaj zawartość artykułu -->
    </article>
    <script>
        function logout() {
    window.location.href = "logout.php";
}
    </script>
</body>
</html>



<?php
require __DIR__ . '/vendor/autoload.php'; // Ścieżka do autoload.php z biblioteki firebase/php-jwt

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
 }

// Klasa reprezentująca zdekodowany token JWT
class DecodedToken {
    public $user_id;
    public $exp;
    
    public function __construct($user_id, $exp) {
        $this->user_id = $user_id;
        $this->exp = $exp;
    }
}

// Sprawdzenie, czy token JWT jest zapisany w sesji
if (!isset($_SESSION['jwt'])) {
    header("Location: LoginPage.php"); // Przekieruj na stronę logowania, jeśli brakuje tokenu w sesji
    exit();
}

$jwt = $_SESSION['jwt'];
$secret = 'SAGJSw152151SKAsaga13';

try {
    $decoded = JWT::decode($jwt, new Key($secret, 'HS256'));
    // Tworzenie obiektu zdekodowanego tokenu jako instancji klasy
    $decoded = new DecodedToken($decoded->user_id, $decoded->exp);
    
} catch (\Exception $e) {
    echo "Błąd dekodowania tokena: " . $e->getMessage()."<br>Przekierowywanie do strony z logowaniem..";
    header("refresh: 3, url=LoginPage.php");
    exit();
}

include 'data.php';
    if($user_id == 27){
        echo '<span style="z-index: -1; color: white;">Użytkownik 27';
    }
?>

