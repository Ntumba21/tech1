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

        

      
        <form action="../controller/register.php" method="post" enctype="multipart/form-data">
            <div class="form">
                
                <input type="hidden" name="type" value="1">
            
           
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required>
           
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" required>
            </div>
            <div class="form">
                <label for="mail">E-mail :</label>
                <input type="email" name="mail" id="mail" required>
            </div>
            <div class="form">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form">
                <label for="date_de_naissance">Date de naissance :</label>
                <input type="date" name="date_de_naissance" id="date_de_naissance" required>
            </div>
            <div class="form">
                <label for="description">Description :</label><br>
                <input type="text" name="description" id="description"></textarea>
            </div>
            <div class="form">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville" required>
            </div>
            <div class="form">
                <label for="interests">Intérêts :</label>
                <input type="text" name="interests" id="interests">
            </div>
            <div class="form">
                <label for="photo">Photo :</label>
                <input type="file" name="photo" id="photo">
            </div>
            <div class="form">
                <label for="idpromos">Promos :</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                    <!-- Ajoutez les options pour les différentes promotions ici -->
                    <?php ShowPromoEleve(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <button type="submit">Créer un compte<a href="../view/loginform.php"></a></button>
        </form>
                 </div>
                 
                 <p><a href="../view/reinitialisationMDP.php">forgot password?</a><br></p>
              

</div>
</div>
</body>
<!--
<footer>
<a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
</footer>  -->

</html>

