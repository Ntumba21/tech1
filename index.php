<?php require_once 'controller/session.php'; session_destroy();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <link rel="stylesheet" href="view/style/index.css">
    <body>

    <div class="textbox">
    <h1>WELCOME TO <br> ECEBOOK</h1>
    <h2>ECEBOOK helps you to connect,
        create, delete, modify a post and send message
    </h2>
    </div>
    <div class="container" style="background-color: transparent">


       
        <button onclick="window.location.href='view/admin/index.html'">CONNEXION ADMIN</button>
        <button onclick="window.location.href='view/loginform'">ME CONNECTER</button>
        <button onclick="window.location.href='view/register'">CREER UN COMPTE ELEVE</button>
        <button onclick="window.location.href='view/register-prof'">CREER UN COMPTE PROFESSEUR</button>





    </div>


</body>
</html>