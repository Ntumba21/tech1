<?php require_once '../../controller/session.php';
//pour verifier si la session est valide
//if(!VerifySession()){header('Location: index.html');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../view/style/post.css">
</head>
<body>

    <section class="createPost">

<header>
    <img src="../../media/logo ECEBOOK.png" alt="Logo" class="logo"> 
    <h1>Create post Admin</h1>
</header>
<div class="content">
    <div class="square">
    <form name="ajouter-post" method="post" action="../../controller/admin/create-post.php" enctype="multipart/form-data">
        <input type="hidden" name="action" value="create">
        <label for="type">Type :</label>
        <select name="type" id="type">
            <option value="actualités">Actualités</option>
            <option value="événements">Événements</option>
            <option value="général">Général</option>
        </select><br>
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre"><br>
        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu"></textarea><br>
        <label for="lieu">Nom du lieu :</label>
        <input type="text" name="lieu" id="lieu"><br>
        <label for="photo">Photo :</label>
        <input type="file" name="photo" id="photo"><br>
        <label for="for">Pour :</label>
        <select name="for" id="for">
            <option value="0">Tous</option>
            <option value="1">Eleve</option>
            <option value="2">Professeur</option>
        </select><br>
        <button type="submit" name="submit">Publier</button>
    </form>
</section>
</div>
</div>
</body>


</html>


