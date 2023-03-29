<?php require_once ('..\controller\session.php ');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="../view/style/loginForm.css">

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

            <label for="email">Adresse e-mail :
            <input type="email" name="email" required><br></label>
            <?php if (isset($_SESSION['html-login'])){
                echo $_SESSION['html-login'];
            }?>
            <label for="password">Mot de passe :
            <input type="password" name="password" required></label>

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
