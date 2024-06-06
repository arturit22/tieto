<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admini sisselogimine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .login-container {
            width: 300px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .login-container input[type="text"], .login-container input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .login-container input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h1>Admini sisselogimine</h1>
    <?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo "<p class='error'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>
    <form method="POST" action="admin_handler.php">
        <input type="text" name="kasutajanimi" placeholder="Kasutajanimi" required>
        <input type="password" name="parool" placeholder="Parool" required>
        <input type="submit" value="Logi sisse">
    </form>
</div>
</body>
</html>
