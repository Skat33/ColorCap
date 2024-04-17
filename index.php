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
        <div id="container">
            <h1>Mistrzostwa Europy w Piłce Nożnej 2024</h1>
    Mistrzostwa Europy w Piłce Nożnej 2024 to jedno z najważniejszych wydarzeń sportowych na starym kontynencie.<br>
     Turniej finałowy odbędzie się w Niemczech i potrwa od 14 czerwca do 14 lipca 2024 roku. W sumie zostanie rozegranych 51 meczów. <br>
     Oto kilka kluczowych informacji:
    <ul>
        <li>Gospodarz: Niemcy (po raz drugi, poprzednio w 1988 roku jako RFN).</li>
        <li>Stadiony: Turniej będzie rozgrywany na dziesięciu stadionach, w tym m.in. na Olympiastadion w Berlinie (finał) oraz Allianz Arena w Monachium (mecz otwarcia).</li>
        <li>Losowanie grup: Odbyło się 2 grudnia 2023 roku w Hamburgu.</li>
        <li>Inauguracja: 14 czerwca w Monachium o godzinie 21:00 (spotkanie Niemcy | Szkocja). </li>
        <li>Finał: 14 lipca o 21:00 na Stadionie Olimpijskim w Berlinie.</li>
     </ul>
Lista uczestników Mistrzostw Europy obejmuje 21 z 24 drużyn, w tym Reprezentację Polski, która zakwalifikowała się poprzez baraże.
    </div></article>
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



// Klasa reprezentująca zdekodowany token JWT
class DecodedToken {
    public $user_id;
    public $exp;
    
    public function __construct($user_id, $exp) {
        $this->user_id = $user_id;
        $this->exp = $exp;
    }
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
 }
// Sprawdzenie, czy token JWT jest zapisany w sesji
if (!isset($_SESSION['jwt'])) {
    header("Location: LoginPage.php"); // Przekieruj na stronę logowania, jeśli brakuje tokenu w sesji
    exit();
}
if (isset($_GET['user_id'])) {
    // Jeśli parametr user_id został przekazany, sprawdź, czy jest to identyfikator bieżącego użytkownika
    if ($_GET['user_id'] != $user_id) {
        // Jeśli parametr user_id nie zgadza się z identyfikatorem bieżącego użytkownika, przekieruj użytkownika na stronę błędu lub inny adres URL
        header("Location: konto.php?user_id=$user_id");
        exit();
    }
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

