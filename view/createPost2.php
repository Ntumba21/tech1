<?php require_once ("../controller/session.php");
// decommenter pour activer la verification de session
//if(!VerifySession()){header('Location: ../index.php');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un post</title>
    <link rel="stylesheet" href="../view/style/post.css">

</head>
<body>
<header>
    <img src="../media/logo ECEBOOK.png" alt="Logo" class="logo"> 
    <h1>Create post</h1>
</header>
<div class="content">
    <div class="square">
</head>
<form action="../controller/createPost2.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="create">
    <label for="type">Type :</label>
    <select name="type" id="type">
        <option value="actualités">Actualités</option>
        <option value="événements">Événements</option>
        <option value="général">Général</option>
    </select><br>
    <label for="titre">Titre :</label>
    <input type="text" name="titre" id="titre" required><br>
    <label for="contenu">Contenu :</label>
    <textarea name="contenu" id="contenu" maxlength="500" required></textarea><br>
    <label for="date">Date :</label>
    <input type="date" name="date" id="date" required><br>
    <label for="lieu">Lieu :</label>
    <input type="text" name="lieu" id="lieu" required><br>
    <label for="photo">Photo :</label>
    <input type="file" name="photo" id="photo"><br>
    <button type="submit">Publier</button>
</form>
</div>
</div>
</body>
<footer>
<a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
</footer>

</html>
