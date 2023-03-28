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
    <link rel="stylesheet" href="../view/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
        <div class="header-container">
            <div class="header-wrapper">
                <div class="logoBox">
                    <img src="../media/logo ECEBOOK.png" alt="logo">
                </div>
                <div class="searchBox">
                    <input type="search">
                    <i class="fas fa-search"></i>
                </div>
                <div class="iconBox2">
                <i class="fa-solid fa-house"></i>
                    <i class="fa-solid fa-bell"></i>
                    <label>  <a href="../../facebookk/profil.php">
                    <img src="../facebookk/images/us2.png" alt="user">
                     </label></a>
                </div>
            </div>
        </div>
    </header>


    <div class="home">
    <div class="container">
        <div class="home-weapper">

           <!--GAUCHE-->
            <div class="home-left">
                 <!-- BON-->
  


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
<footer>
    <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofia </a>
</footer>
</body>
</html>