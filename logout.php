<?php
// Rozpoczęcie sesji
session_start();

// Zniszczenie sesji
session_destroy();

// Przekierowanie użytkownika na stronę logowania
header("Location: LoginPage.php");
exit; // Zapobiega dalszemu wykonywaniu kodu po przekierowaniu
?>
