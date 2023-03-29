<?php require_once ('..\..\modele\Database.php'); require_once '../../controller/session.php';
//pour verifier si la session est valide
//if(!VerifySession()){header('Location: index.html');} ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreateAdmin</title>
    <link rel="stylesheet" href="../../view/style/loginForm.css">
</head>  
<div class="textbox">
<h1>Create Admin</h1>
<h2>ECEBOOK helps you to connect,
    create, delete, modify a post and send message
</h2>
</div>
<div class="container" style="background-color: transparent">
<div class="form">
    
    <form name="ajouter-admin" method="post" action="../../controller/admin/create-admin.php">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom"><br>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email"><br>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password"><br>
        <button type="submit" name="submit">Créer</button>
    </form>
</div>
</body>
</html>
