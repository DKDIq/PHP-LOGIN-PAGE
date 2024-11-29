<?php
if (isset($_COOKIE['user_token'])) {
    header("Location: serwer.php?akcja=sprawdz_dane");
    exit();
}
if(isset($_GET['result'])){
    $error_message = $_GET['result'];
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: #f44336;
            font-size: 14px;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>Logowanie</h1>

    <form method="POST" action="serwer.php">
        <input type="hidden" name="akcja" value="log">
        <input type="text" name="email" id="email" class="input-field" placeholder="email" required />
        <input type="password" name="haslo" id="haslo" class="input-field" placeholder="Hasło" required />
        <button type="submit" class="login-button">Zaloguj się</button>
    </form>

    <?php
    if (isset($error_message)) {
        echo "<div class='error-message'>$error_message</div>";
    }
    ?>

</div>

</body>
</html>
