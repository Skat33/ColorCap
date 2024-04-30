    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Projekt";

    // Tworzenie połączenia
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Sprawdzenie połączenia
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Pobranie ID użytkownika z sesji lub innego źródła
    // Załóżmy, że ID użytkownika przechowywane jest w sesji

        // Teraz masz nazwę użytkownika, którą możesz wykorzystać w pliku index.php

    // Zapytanie SQL, aby pobrać dane użytkownika na podstawie jego ID
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Wyświetlenie danych użytkownika
        while($row = $result->fetch_assoc()) {
            $username = $row["username"];
            $imie = $row["Imie"];
            $nazwisko = $row["Nazwisko"];
            $data = $row["Data"];
            $email = $row['e-mail'];
            // Wyświetl inne dane użytkownika
        }
    } else {
        echo "Brak danych użytkownika";
    }

    ?>