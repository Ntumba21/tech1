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
    <link rel="stylesheet" href="../../facebookk/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
        <div class="header-container">
            <div class="header-wrapper">
                <div class="logoBox">
                    <img src="../../media/logo ECEBOOK.png" alt="logo">
                </div>
                <div class="searchBox">
                    <input type="search">
                    <i class="fas fa-search"></i>
                </div>
                <div class="iconBox2">
                <i class="fa-solid fa-house"></i>
                    <i class="fa-solid fa-bell"></i>
                    <label>  <a href="../../facebookk/profil.php">
                    <img src="../../facebookk/images/us2.png" alt="user">
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
  
                 <div class="createPost">
    <h3 class="mini-headign">Create post Admin</h3> 
  
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
        <label for="link">Lien :</label>
        <input type="text" name="link" id="link"><br>
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


