<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <style>
         
        body {
            background-color: #fff;
            color: #000;
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        form {
            margin: 0 auto;
            width: 400px;
            border: 2px solid #000;
            padding: 20px;
        
        }
        label {
            display: block;
            margin-bottom: 10px;

        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        button[type="submit"] {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #444;
        }
    </style>
      
</head>
<body>
<img src="../media/logo ECEBOOK.png" alt="Logo" class="logo">
<h1>Connexion</h1>

<form action="../controller/login.php" method="post">
    <label for="email">Adresse e-mail :</label>
    <input type="email" name="email" required><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>

    <button type="submit">Se connecter</button>
</form>

</body>
</html>
