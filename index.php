<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #1a1a1a;
            color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
            color: #00aaff;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            background: #2c2c2c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #bfbfbf;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #555;
            border-radius: 5px;
            background: #333;
            color: #f5f5f5;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #00aaff;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0088cc;
        }

        .toggle-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .toggle-container input {
            margin-right: 8px; /* Mały odstęp między checkboxem a tekstem */
        }

        .toggle-container label {
            color: #bfbfbf;
            cursor: pointer;
        }

        .error {
            color: #ff4d4d;
            font-size: 14px;
            text-align: center;
            margin-bottom: 15px;
        }

        .result {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
            color: #00ff00;
        }
    </style>
</head>
<body>
<h1>Rejestracja</h1>

<?php
if(isset($_COOKIE["user_token"])){
header("Location: serwer.php?akcja=sprawdz_dane");}

if (isset($_GET['result'])) {
    echo "<div class='result'>" . htmlspecialchars($_GET['result']) . "</div>";
}
?>

<form action="serwer.php" method="POST" onsubmit="return sprawdzHasla()">
    <input type="hidden" name="akcja" value="reje">

    <label for="nick">Nick:</label>
    <input type="text" id="nick" name="nick" required>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>

    <label for="haslo">Hasło:</label>
    <input type="password" id="haslo" name="haslo" required>

    <label for="haslo1">Powtórz Hasło:</label>
    <input type="password" id="haslo1" name="haslo1" required>

    <div class="toggle-container">
        <input type="checkbox" id="togglePassword" onclick="togglePasswords()">
        <label for="togglePassword">Pokaż hasła</label>
    </div>

    <button type="submit">Rejestruj</button>
    <p id="komunikat" class="error"></p>
</form>

<script>
    function sprawdzHasla() {
        const haslo = document.getElementById('haslo').value;
        const haslo1 = document.getElementById('haslo1').value;
        const komunikat = document.getElementById('komunikat');

        if (haslo !== haslo1) {
            komunikat.textContent = "Hasła nie są zgodne!";
            return false;
        }

        komunikat.textContent = "";
        return true;
    }

    function togglePasswords() {
        const haslo = document.getElementById('haslo');
        const haslo1 = document.getElementById('haslo1');
        const type = haslo.type === 'password' ? 'text' : 'password';
        haslo.type = type;
        haslo1.type = type;
    }
</script>
</body>
</html>
