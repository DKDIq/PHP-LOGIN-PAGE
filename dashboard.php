<?php
if (isset($_GET['result'])) {
    $result = htmlspecialchars($_GET['result']);
    $nick = htmlspecialchars($_GET['Nick']);
    $haslo = htmlspecialchars($_GET['Hasło']);
} else {
    if (isset($_COOKIE['user_token'])) {
        header("Location: serwer.php?akcja=sprawdz_dane");
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wynik operacji</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .result {
            background-color: #e8f5e9;
            color: #388e3c;
            border: 1px solid #81c784;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 18px;
        }

        .info-box {
            background-color: #ffeb3b;
            padding: 15px;
            border-radius: 5px;
            margin-top: 30px;
            color: #000;
            font-size: 16px;
            border: 1px solid #fbc02d;
        }

        .card {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .logout-button {
            display: block;
            width: 200px;
            margin: 30px auto;
            padding: 10px;
            background-color: #f44336;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .logout-button:hover {
            background-color: #e53935;
        }

        .card h3 {
            font-size: 22px;
            color: #4CAF50;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 16px;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Panel użytkownika</h1>

    <div class="result">
        <strong>Wynik operacji:</strong> <?php echo $result; ?>
    </div>

    <div class="card">
        <h3>Twoje dane</h3>
        <p><strong>Nick:</strong> <?php echo $nick; ?></p>
        <p><strong>Hasło:</strong> <?php echo $haslo; ?></p>
    </div>


    <div class="info-box">
        <h3>Informacje</h3>
        <p>Twoje dane są przechowywane w naszym systemie w sposób bezpieczny i zgodny z polityką prywatności. Jeśli masz jakiekolwiek pytania, skontaktuj się z nami.</p>
    </div>
</div>

</body>
</html>
