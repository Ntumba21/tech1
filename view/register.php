<?php require_once '../controller/promo.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../view/style/stylee.css">
   
    
    </head>
<body>

<header>
    <img src="../media/logo ECEBOOK.png" alt="Logo" class="logo"> 
    <h1>Inscription</h1>
</header>
<div class="content">
    <div class="square">
      
        <form action="../controller/register.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="type">Elève</label>
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

<footer>
 <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofia </a>
</footer>
</body>
</html>

