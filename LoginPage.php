<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="POST">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="log_user" placeholder="User name" required="">
                <input type="text" name="imie" placeholder="Name" required="">
                <input type="text" name="nazwisko" placeholder="Surname" required="">
                <input type="email" name="log_email" placeholder="Email" required="">
                <input type="password" name="log_password" placeholder="Password" required="">
                <div id="agree">
                    <input type="checkbox" id="agree" name="agree" required>
                    <span><a href="polityka.php" target="_blank">Wyrażam zgodę na przetwarzanie moich danych
                            osobowych.</a></span>
                </div>
                <button name="sign-up">Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="POST" name="login">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="text" name="loguser" placeholder="Username" required="">
                <input type="password" name="logpassword" placeholder="Password" required="">
                <button id="sign-in" name="sign-in">Login</button>
                <div id="login-failed">
                    <span id="login-err">Nieprawidłowe dane logowania</span>
                </div>
                <div id="login-success">
                    <span id="login-succ">Zalogowano!</span>
                </div>
                <div id="buttonload" class="buttonload">
                    <i class="fa fa-circle-o-notch fa-spin"></i>
                </div>
            </form>
        </div>

        <div id="password-error"></div>
        <script>
        // Sprawdź, czy hash URL zawiera login, jeśli tak, ustaw fokus na sekcji logowania
        window.onload = function() {
            var chk = document.getElementById('chk');
            chk.checked = true;
        };

        function showLoadingIcon() {
            // Pokazujemy ikonę ładowania po kliknięciu przycisku "Login"
            document.getElementById("buttonload").style.display = "block";
        }

        function hideLoadingIcon() {
            // Pokazujemy ikonę ładowania po kliknięciu przycisku "Login"
            document.getElementById("buttonload").style.display = "none";
        }
        </script>

</body>

</html>
<?php
require_once __DIR__ . '/vendor/autoload.php'; // Ścieżka do autoload.php z biblioteki firebase/php-jwt

use Firebase\JWT\JWT;

// Połączenie z bazą danych
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'Projekt';
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Funkcja do rejestracji użytkownika
if (isset($_POST['sign-up'])){
function registerUser($conn, $username, $password, $imie, $nazwisko, $email) {
    // Walidacja danych wejściowych
    if (empty($username) || empty($password) || empty($email) || empty($imie) || empty($nazwisko)) {
        throw new Exception("Wszystkie pola są wymagane.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Niepoprawny format adresu e-mail.");
    }

    // Sprawdzenie, czy użytkownik o podanej nazwie już istnieje
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        throw new Exception("<span id='user-error'>Użytkownik o tej nazwie już istnieje.</span>");
    }

    // Rejestracja użytkownika
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $date = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO users (username, password, `Imie`, `Nazwisko`, `e-mail`, Data) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $hashed_password, $imie, $nazwisko, $email, $date);
    if (!$stmt->execute()) {
      throw new Exception("Błąd podczas rejestracji użytkownika.");
  }
  $stmt->close();
}

// Ustawienie strefy czasowej
date_default_timezone_set('Europe/Warsaw');

// Pobieranie danych z formularza
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['log_user'];
    $password = $_POST['log_password'];
    $email = $_POST['log_email'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];

    try {
        // Rejestracja użytkownika
        registerUser($conn, $username, $password, $imie, $nazwisko, $email);

        echo '<span id="register-success">Zarejestrowano pomyślnie. Możesz się teraz zalogować!</span>';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
}
else if (isset($_POST['sign-in'])){


// Połączenie z bazą danych
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'Projekt';
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Funkcja do logowania użytkownika
function loginUser($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($password, $user['password'])) {
        $token = generateJWT($user['ID']);
        return $token;
    } else {
        return false;
    }
}

// Funkcja do generowania tokena JWT
function generateJWT($user_id) {
    $payload = [
        'user_id' => $user_id,
        'exp' => time() + (60 * 60) // Token wygasa po 1 godzinie
    ];

    $secret = 'SAGJSw152151SKAsaga13'; // 
    return JWT::encode($payload, $secret, 'HS256');
}

// Pobieranie danych z formularza
    $username = $_POST['loguser'];
    $password = $_POST['logpassword'];

    // Logowanie użytkownika
    $token = loginUser($conn, $username, $password);

    if ($token) {
        // Zapisanie tokenu w sesji
        // Zapisanie tokenu w sesji
session_start();
$_SESSION['jwt'] = $token;
    echo '<script>
    document.getElementById("login-success").style.display = "block";
    var element = document.querySelector(".login");
    element.style.transition = "all 0.5s ease-in-out";
    showLoadingIcon();
    setTimeout(function() {
        window.location.href = "index.php";
    }, 2500); 
    </script>';
               exit(); // Dodane, aby przerwać dalsze wykonywanie kodu
    } else {
        // Ustawienie nagłówków przed wyświetleniem treści
        echo '<script>
             document.getElementById("login-failed").style.display = "block";
            var element = document.querySelector(".login");
            element.style.transition = "all 0.5s ease-in-out";
        </script>';
        exit(); // Dodane, aby przerwać dalsze wykonywanie kodu
    }

}

?>