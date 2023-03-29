
<?php 
require_once '../modele/Database.php';
require_once '../controller/session.php';
$user_email = $_SESSION['mail'];
$db = new Database();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>facebook.com</title>
    <!-- style css link -->
    <link rel="stylesheet" href="style.css">
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    
<!-- header section start -->


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
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
        </div>
    </div>
</header>
    


    <div class="home-center">
                <div class="home-center-wrapper">


                    <div class="createPost">

                    <form action="../controller/createpostActualite.php" method="post" enctype="multipart/form-data">
                    <h3 class="mini-headign">Create post</h3>
                    <div class="post-text">
  <input type="hidden" name="action" value="create">
  <select name="type" id="type">
    <option value="1">Actualités</option>
  </select><br>
  <input type="text" name="titre" id="titre" placeholder="Titre"><br>
  <input type="text" name="contenu" id="contenu" placeholder="Contenu"><br>
  <input type="date" name="date" id="date" placeholder="Date"><br>
  <input type="text" name="lieu" id="lieu" placeholder="Nom du lieu"><br>
  <input type="text" name="identification" id="identification" placeholder="Identification">
  <input type="link" name="link" id="link" placeholder="link">
  <input type="file" name="photo" id="photo">
    </div>
  <button type="submit">Publier</button>
</form>


                    </div>
                    </div>
                    </div>
<!-- home section end -->





</body>
</html>