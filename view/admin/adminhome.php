<?php require_once '../../controller/session.php';
//pour verifier si la session est valide
//if(!VerifySession()){header('Location: index.html');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../view/style/loginForm.css">
    </head>

<div class="textbox">
<h1>WELCOME ADMIN</h1>
<h2>ECEBOOK helps you to connect,
    create, delete, modify a post and send message
</h2>
</div>
<div class="container" style="background-color: transparent">
    

    <h2>Que voulez vous faire?</h2>
    <button onclick="window.location.href='statistique.php'">Afficher les statistiques</button>
    <button onclick="window.location.href='post.php'"> Gérer les posts</button>
    <button onclick="window.location.href='manage-user'">Gérer les utilisateurs</button>
    <button onclick="window.location.href='create-admin'">Créer un admin</button>

    


<body>
<!--TODO ici faut faire les liens vers les differentes autres pages-->
<!--TODO premier lien vers les statistiques.php-->
<!--TODO deuxieme lien vers les posts.php-->
<!--TODO troisieme lien vers les users.php-->
</body>
</div>
</div>
</body>

</html>