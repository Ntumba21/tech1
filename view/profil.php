<?php
require_once '../modele/Database.php';
require_once '../controller/editprofil.php';
require_once '../controller/session.php';
require_once '../controller/login.php';
require_once '../controller/promo.php';
// decommenter pour activer la verification de session
//if(!VerifySession()){header('Location: ../index.php');}

$mail= $_SESSION['mail'];
$database = new Database();
$user = $database->getUserByEmail($mail);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Profil </title>
    <link rel="stylesheet" href="../view/style/style.css">
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
  
    
    <!-- <div class="createPost"> -->
    <h1 class="mini-headign">Inscription</h1>
  </head>
  <body>
    <h1>Profil de <?php echo $user["prenom"] . " " . $user["nom"]; ?></h1>
    
    
    <div id="left-container-account ">
      
      <div style="margin-top:100px">
        <img class="rounded-circle" src="<?php echo $user['photo'] ?>" width="100" alt="user">
      </div>

    <form action="../controller/editprofil.php" method="POST" enctype="multipart/form-data">
      <label for="nom">Nom*: </label>
      <input type="text" id="nom" name="nom" value="<?php echo $user["nom"]; ?>"><br>

      <label for="prenom">Prénom*: </label>
      <input type="text" id="prenom" name="prenom" value="<?php echo $user["prenom"]; ?>"><br>

      <label for="date_de_naissance">Date de naissance*: </label>
      <input type="date" id="date_de_naissance" name="date_de_naissance" value="<?php echo $user["date_de_naissance"]; ?>"><br>

      <label for="description">Description: </label>
      <textarea id="description" name="description"><?php echo $user["description"]; ?></textarea><br>

      <label for="ville">Ville: </label>
      <input type="text" id="ville" name="ville" value="<?php echo $user["ville"]; ?>"><br>

      <label for="interests">Centres d'intérêt: </label>
      <input type="text" id="interests" name="interests" value="<?php echo $user["interests"]; ?>"><br>

      <label for="photo">Photo:</label>
      <input type="file" name="photo"><br><br>
      
        <input type="submit" name="submit" value="Enregistrer les modifications">
    </form>
</body>
</html>
