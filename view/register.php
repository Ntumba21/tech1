<?php require_once '../controller/promo.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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

                 <div class="createPost">
    <h1 class="mini-headign">Inscription</h1>
    <div class="post-text">
    
                <i class="fa-solid fa-user-group">Eleve</i>
      
        <form action="../controller/register.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                
                <input type="hidden" name="type" value="1">
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" required>
            </div>
            <div class="form-group">
                <label for="mail">E-mail :</label>
                <input type="email" name="mail" id="mail" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="date_de_naissance">Date de naissance :</label>
                <input type="date" name="date_de_naissance" id="date_de_naissance" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville" required>
            </div>
            <div class="form-group">
                <label for="interests">Intérêts :</label>
                <input type="text" name="interests" id="interests">
            </div>
            <div class="form-group">
                <label for="photo">Photo :</label>
                <input type="file" name="photo" id="photo">
            </div>
            <div class="form-group">
                <label for="idpromos">Promos :</label>
                    <!-- Ajoutez les options pour les différentes promotions ici -->
                    <?php ShowPromoEleve(); ?>
            </div>
            <button type="submit">Créer un compte</button>
        </form>
                 </div>
</div>
</div>

<footer>
 <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofia </a>
</footer>
</body>
</html>

