<?php require_once '../controller/promo.php'; require_once '../controller/session.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../view/style/loginForm.css">
    
</head>
<body>


<div class="textbox">
<h1>Connexion</h1>
<h2>ECEBOOK helps you to connect,
    create, delete, modify a post and send message
</h2> 
</div>
<div class="container">
    <div class="form">

                    <i class="fa-solid fa-user-group">Professeur</i>

            <form action="../controller/register.php" method="post">
                <?php echo  $_SESSION['alert-register']; ?>
                <div class="form-group">
                    <input type="hidden" name="type" value="2">
                </div>
                <div class="form-group">
                    <label for="nom">Nom :
                        <input type="text" name="nom" id="nom" required></label>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom :
                    <input type="text" name="prenom" id="prenom" required>
                </div>
                <div class="form-group">
                    <label for="mail">E-mail :
                    <input type="email" name="mail" id="mail" required></label>
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
                        <?php ShowPromoProf(); ?>
                </div>
                <button type="submit">Créer un compte</button>
            </form>

    </div>
</div>


</body>
</html>

