<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hinnangu lisamine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Hinnangu lisamine</h2>

    <?php
    // Veateated
    $errors = [];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $errors[] = "Nime väli on kohustuslik!";
        }
        if (!isset($_POST["rating"])) {
            $errors[] = "Palun valige hinnang!";
        }
    }

    if (!empty($errors)) {
        echo "<div class='error-message'><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    }
    ?>

    <form action="salvesta_hinnang.php" method="POST">
        <label for="username">Teie nimi:</label>
        <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>

        <label>Hinnang:</label>
        <label><input type="radio" name="rating" value="1" <?php echo isset($_POST['rating']) && $_POST['rating'] == '1' ? 'checked' : ''; ?>> 1</label>
        <label><input type="radio" name="rating" value="2" <?php echo isset($_POST['rating']) && $_POST['rating'] == '2' ? 'checked' : ''; ?>> 2</label>
        <label><input type="radio" name="rating" value="3" <?php echo isset($_POST['rating']) && $_POST['rating'] == '3' ? 'checked' : ''; ?>> 3</label>
        <label><input type="radio" name="rating" value="4" <?php echo isset($_POST['rating']) && $_POST['rating'] == '4' ? 'checked' : ''; ?>> 4</label>
        <label><input type="radio" name="rating" value="5" <?php echo isset($_POST['rating']) && $_POST['rating'] == '5' ? 'checked' : ''; ?>> 5</label>
        <label><input type="radio" name="rating" value="6" <?php echo isset($_POST['rating']) && $_POST['rating'] == '6' ? 'checked' : ''; ?>> 6</label>
        <label><input type="radio" name="rating" value="7" <?php echo isset($_POST['rating']) && $_POST['rating'] == '7' ? 'checked' : ''; ?>> 7</label>
        <label><input type="radio" name="rating" value="8" <?php echo isset($_POST['rating']) && $_POST['rating'] == '8' ? 'checked' : ''; ?>> 8</label>
        <label><input type="radio" name="rating" value="9" <?php echo isset($_POST['rating']) && $_POST['rating'] == '9' ? 'checked' : ''; ?>> 9</label>
        <label><input type="radio" name="rating" value="10" <?php echo isset($_POST['rating']) && $_POST['rating'] == '10' ? 'checked' : ''; ?>> 10</label>

        <label for="comment">Kommentaar:</label>
        <textarea id="comment" name="comment" rows="4" cols="50"><?php echo isset($_POST['comment']) ? $_POST['comment'] : ''; ?></textarea>

        <input type="submit" value="Salvesta hinnang">
    </form>
</div>

</body>
</html>
