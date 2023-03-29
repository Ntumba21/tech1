<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="../view/style/post.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
    <div class="header-container">
        <div class="header-wrapper">
        <?php $user = $db->getUserByEmail($_SESSION['mail']);?>
            <div class="logoBox">
                <img src="../media/logo ECEBOOK.png" alt="logo">
            </div>
            <div class="searchBox">
                <input type="search">
                <i class="fas fa-search"></i>
            </div>
            <div class="iconBox2">
                <!-- Lien vers index.php avec l'icône de la maison -->
                <a href="../facebookk/index.php">
                    <i class="fa-solid fa-house"></i>
                </a>
                <i class="fa-solid fa-bell"></i>
                <a href="../facebookk/profil.php">
                    <img src="<?php echo $user['photo'] ?>"  alt="user">
                </a>
                <!-- Bouton de déconnexion -->
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> 
                </a>
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
    <h1 class="mini-headign">Réinitialisation du mot de passe</h1>


        <form action="../controller/pageReinitialisation.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
            <div class="form-group">
                <label for="password">Nouveau mot de passe :</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmez le nouveau mot de passe :</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <button type="submit">Mettre à jour le mot de passe</button>
        </form>
    </div>
</div>
<br><br>
 <footer>
<a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
</footer>    
</body>
</html>
