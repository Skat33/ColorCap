   <?php

   // Pobieranie ID uzytkownika z obecnej sesji
   if (session_status() == PHP_SESSION_NONE) {
   session_start();
   }
   if (isset($_SESSION['jwt'])) {
   // Zdekoduj token JWT
   $token = $_SESSION['jwt'];
   $token_parts = explode('.', $token);
   $token_payload = base64_decode($token_parts[1]);
   $payload = json_decode($token_payload);

   // Pobierz nazwę użytkownika z payloadu
   $user_id = $payload->user_id;
   }
   ?>