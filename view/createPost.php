<?php require_once ("../controller/session.php");
// decommenter pour activer la verification de session
//if(!VerifySession()){header('Location: ../index.php');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../view/style/loginForm.css">
   
    </head>
<body>


<div class="textbox">
<h1>Créer un post</h1>
<h2>ECEBOOK helps you to connect,
    create, delete, modify a post and send message
</h2> 
</div>
<div class="container">
<div class="form">

<form action="../controller/createPostController.php" method="post" enctype="multipart/form-data">
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
  <label for="date">Date :</label>
  <input type="date" name="date" id="date"><br>
  <label for="lieu">Nom du lieu :</label>
  <input type="text" name="lieu" id="lieu"><br>
  <label for="adresse_lieu">Adresse du lieu :</label>
  <input type="text" name="adresse_lieu" id="adresse_lieu"><br>
  <label for="identification">Identification</label>
  <input type="text" name="identification" id="identification"><br>
  <label for="photo">Photo :</label>
  <input type="file" name="photo" id="photo"><br>
  <button type="submit">Publier</button>
</form>
                 </div>
</div>
</div>
</body>


</html>