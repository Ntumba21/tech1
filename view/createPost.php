<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="../controller/createPostController.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="action" value="create">
  <label for="type">Type :</label>
  <input type="text" name="type" id="type"><br>
  <label for="titre">Titre :</label>
  <input type="text" name="titre" id="titre"><br>
  <label for="contenu">Contenu :</label>
  <textarea name="contenu" id="contenu"></textarea><br>
  <label for="date">Date :</label>
  <input type="date" name="date" id="date"><br>
  <label for="lieu">Lieu :</label>
  <input type="text" name="lieu" id="lieu"><br>
  <label for="photo">Photo :</label>
  <input type="file" name="photo" id="photo"><br>
  <button type="submit">Publier</button>
</form>

</body>
</html>