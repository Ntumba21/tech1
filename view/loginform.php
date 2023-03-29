<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="../view/style/post.css">
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
    <h3 class="mini-headign">Connexion</h3>
    
    
<form action="../controller/login.php" method="post">
    <label for="email">Adresse e-mail :</label>
    <input type="email" name="email" required><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>

    <button type="submit">Se connecter</button>
</form>
    </div>
</div>

</body>
<footer>
    <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
</footer>
</html>
