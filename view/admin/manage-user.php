<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/showuser.php");
//if(!VerifySession()){header('Location: index.html');}?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <link rel="stylesheet" href="../../view/style/loginForm.css">

        </head>

<div class="textbox">
<h1>User</h1>
<h2>ECEBOOK helps you to connect,
    create, delete, modify a post and send message
</h2>
</div>
<div class="container" style="background-color: transparent">
 
    
    <button onclick="window.location.href='block-user'">Bloquer un utilisateur</button>
    <button onclick="window.location.href='deblock-user'">Débloquer un utilisateur</button>
    <button onclick="window.location.href='delete-user'">Supprimer un utilisateur</button>
<!--    TODO: faut faire les liens pour les pages de blocages et deblocages ici-->
   


    </div>

</body>


</html>

