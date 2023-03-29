<?php require_once '../controller/promo.php'; require_once '../controller/session.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../view/style/register.css">
    </head>
<body>
<div class="textbox">
<h1>Inscription eleve</h1>
<h2>ECEBOOK helps you to connect,
    create, delete, modify a post and send message
</h2> 

<div class="container">
    <div class="form">
            <form action="../controller/register.php" method="post" enctype="multipart/form-data">
                    <?php echo  $_SESSION['alert-register']; ?>
                    <input type="hidden" name="type" value="1">


                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" required>


                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" required>

                    <label for="mail">E-mail :</label>
                    <input type="email" name="mail" id="mail" required>

                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password" required>

                    <label for="date_de_naissance">Date de naissance :</label>
                    <input type="date" name="date_de_naissance" id="date_de_naissance" required>

                    <label for="description">Description :</label><br>
                    <input type="text" name="description" id="description"></textarea>

                    <label for="ville">Ville :</label>
                    <input type="text" name="ville" id="ville" required>

                    <label for="interests">Intérêts :</label>
                    <input type="text" name="interests" id="interests">

                    <label for="photo">Photo :</label>
                    <input type="file" name="photo" id="photo">
                    <label for="idpromos">Promos :</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <!-- Ajoutez les options pour les différentes promotions ici -->
                        <?php ShowPromoEleve(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <button type="submit">Créer un compte</button>
            </form>
    </div>
                
                 
</body>
<!--
<footer>
<a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
</footer>  -->

</html>

