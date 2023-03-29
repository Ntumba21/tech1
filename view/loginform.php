<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="../view/style/manage.css">
   
</head>
<body>

<div class="textbox">
<h1>Connexion</h1>
<h2>ECEBOOK helps you to connect,
    create, delete, modify a post and send message
</h2> 
</div>
<div class="container">
<div class="form">
<form action="../controller/login.php" method="post">

    <label for="email">Adresse e-mail :</label>
    <input type="email" name="email" required><br>
    
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>
    
    <button type="submit">Se connecter</button>
   

    <p><a href="../view/reinitialisationMDP.php">forgot password?</a><br></p>
    <div class="btn">
                   
    <button>create New Account<a href="../view/register.php"></a></button>
                 </div>
                 </form>
    </div>
</div>

</body>

</html>
