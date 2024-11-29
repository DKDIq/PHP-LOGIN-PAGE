<?php

$host = 'localhost';
$user = 'TOMASZ';
$password = 'root';
$database = 'rejestracja';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

function generujToken($dlugosc = 32) {
    return bin2hex(random_bytes($dlugosc / 2));
}

if (isset($_GET['akcja'])) {
    $akcja = $_GET['akcja'];

    if ($akcja === 'sprawdz_dane') {
        if (isset($_COOKIE['user_token'])) {
            $cookie = $_COOKIE['user_token'];

            $sqlCheck = "SELECT * FROM users WHERE token = '$cookie'";
            $resultCheck = $conn->query($sqlCheck);

            if ($resultCheck->num_rows > 0) {
                $row = $resultCheck->fetch_assoc();
                $nickFromDb = $row['nick'];
                $hasloFromDb = $row['haslo'];

                header("Location: dashboard.php?result=Zalogowano pomyślnie. &Nick=$nickFromDb&Hasło=$hasloFromDb");
                exit();
            } else {
                setcookie('user_token', '', time() - 3600, '/', '', false, true);
                header("Location: index.php?result=Prosimy zaloguj sie ponownie twoja sesja wygasla.");

                exit();
            }
        } else {
            header("Location: index.php?result=Zaloguj sie.");
            exit();
        }
    } else {
        header("Location: index.php?result=Nieznana akcja.");
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['akcja'])) {
        if ($_POST['akcja'] === 'reje') {
            if (isset($_POST['nick']) && isset($_POST['email']) && isset($_POST['haslo'])) {
                $nick = $conn->real_escape_string($_POST['nick']);
                $email = $conn->real_escape_string($_POST['email']);
                $haslo = $conn->real_escape_string($_POST['haslo']);
                $token = generujToken();

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $sql = "INSERT INTO users (nick, email, haslo, token) VALUES ('$nick', '$email', '$haslo', '$token')";
                    if ($conn->query($sql) === TRUE) {
                        setcookie("user_token", $token, time() + 3600, "/");
                        $result = "Rejestracja zakończona sukcesem! Twój token został ustawiony.";
                    } else {
                        $result = "Błąd przy dodawaniu danych: " . $conn->error;
                    }
                } else {
                    $result = "Niepoprawny e-mail.";
                }
            } else {
                $result = "Brak wymaganych danych.";
            }
        } elseif ($_POST['akcja'] === 'pobierz') {
            if (isset($_POST['email']) && isset($_POST['haslo'])) {
                $email = $conn->real_escape_string($_POST['email']);
                $haslo = $conn->real_escape_string($_POST['haslo']);
                $sql = "SELECT nick, haslo, token FROM users WHERE email = '$email'";
                $resultQuery = $conn->query($sql);

                if ($resultQuery && $resultQuery->num_rows > 0) {
                    $row = $resultQuery->fetch_assoc();
                    if ($haslo === $row['haslo']) {
                        $token = $row['token'];
                        if (!$token) {
                            $token = generujToken();
                            $updateTokenSql = "UPDATE users SET token = '$token' WHERE email = '$email'";
                            $conn->query($updateTokenSql);
                        }
                        setcookie("user_token", $token, time() + 3600, "/");
                        $result = "Logowanie zakończone sukcesem! Twój token został ustawiony.";
                    } else {
                        $result = "Niepoprawne hasło.";
                    }
                } else {
                    $result = "Nie znaleziono użytkownika o podanym e-mailu.";
                }
            } else {
                $result = "Brak danych do logowania.";
            }
        }elseif($_POST['akcja'] === 'log'){
            $email = $conn->real_escape_string($_POST['email']);
            $haslo = $conn->real_escape_string($_POST['haslo']);

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $db_haslo = $row['haslo'];
                $nick = $row['nick'];

                if ($haslo === $db_haslo) {
                    setcookie("user_token", $row['token'], time() + 3600, "/");
                    header("Location: dashboard.php?result=Zalogowano pomyślnie&Nick=" . urlencode($nick) . "&Hasło=" . urlencode($db_haslo));
                    exit();
                } else {
                    $result = "Niepoprawne hasło.";
                }
            } else {
                $result = "Nie znaleziono konta o podanym e-mailu.";
            }
            header("Location: login.php?result=" . urlencode($result));
            exit();



        }
    }

    header("Location: index.php?result=" . urlencode($result));
    exit();
}

$conn->close();
?>
