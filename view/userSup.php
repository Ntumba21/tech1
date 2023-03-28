<?php require_once("../controller/session.php");
// decommenter pour activer la verification de session
//if(!VerifySession()){header('Location: ../index.php');} ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <link rel="stylesheet" href="../facebookk/style.css">
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
    <h1 class="mini-headign">Delete Account</h1> 
   
    <form method="POST" action="../controller/userSup.php">
      <label for="mail">Email:</label>
      <input type="email" name="mail" id="mail" required>
      <br>
      <button type="submit">Delete Account</button>
    </form>
    </div>
</div>
<footer>
<a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
</footer>
</body>


</html>

