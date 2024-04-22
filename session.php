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

if (!isset($_SESSION['jwt'])) {
    // Jeśli token JWT nie jest ustawiony w sesji, przekieruj użytkownika na stronę logowania
    header("Location: LoginPage.php");
    exit(); // Upewnij się, że skrypt przestaje wykonywać się po przekierowaniu
}