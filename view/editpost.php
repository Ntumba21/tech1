<?php
require_once '../modele/Database.php';
require_once '../controller/editpostuser.php';
require_once '../controller/session.php';

// Vérifiez si la session est active, sinon redirigez l'utilisateur vers la page de connexion
//redirectToHome();

$mail= $_SESSION['mail'];
$database = new Database();
$user = $database->getUserByEmail($mail);
// $post = $database->ShowPostByUSer($_SESSION['iduser']);
$idpost = isset($_GET['id']) ? $_GET['id'] : '';
$post = $database->getPostById($idpost);

//var_dump($post)
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
    <link rel="stylesheet" href="../view/style/editpst.css">
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <!-- header section start -->


    <header>
    <div class="header-container">
        <div class="header-wrapper">
        <?php $user = $database->getUserByEmail($_SESSION['mail']);?>
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
                    <i class="fas fa-home"></i>
                </a> 
                
                <a href="../facebookk/profil.php">
                    <img src="<?php echo $user['photo'] ?>"  alt="user" height="50px" width="50px">
                </a>
                <!-- Bouton de déconnexion -->

                <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> 
                </a>
            </div>
        </div>
    </div>
</header>

    

<div class="home-center">
                <div class="home-center-wrapper">
                        
                    </div>

<div class="createPost">
    <h3 class="mini-headign">Modifier Post</h3>
    <div class="post-text">
    
    <form action="../controller/editpostuser.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idpost" value="<?php echo $post['idpost']; ?>"><br>
        type:
    <?php if(isset($post['type']))  ?>
<select  name="type" id="type"> 
<option value="1">Actualités</option>
    <option value="2">Événements</option>
    <option value="3">Général</option>
  </select><br>  
   titre:
    <?php if(isset($post['titre'])) { ?>
<input type="text" name="titre" value="<?php echo $post['titre']; ?>">
<?php } else { ?>
<input type="text" name="titre" value="">
<?php } ?> <br>

contenu:
<?php if(isset($post['contenu'])) { ?>
<input type="text" name="contenu" value="<?php echo $post['contenu']; ?>">
<?php } else { ?>
    <input type="text" name="contenu" value="">
<?php } ?> <br>

date:
jj/mm/aaaa
<br />
<?php if(isset($post['date'])) { ?>
<input type="text" name="date" value="<?php echo $post['date']; ?>">
<?php } else { ?>
<input type="text" name="date" value="">
<?php } ?> <br>

lieu:
<?php if(isset($post['lieu'])) { ?>
<input type="text" name="lieu" id="lieu" value="<?php echo $post['lieu']; ?>">
<?php } else { ?>
<input type="text" name="lieu" id="lieu" value="">
<?php } ?> <br>
<div class="search-lieu-result" style="display: none;"></div>

etiquette:
<?php if(isset($post['etiquette'])) { ?>
<input type="text" name="etiquette" id="identification" value="<?php echo $post['etiquette']; ?>">
<?php } else { ?>
<input type="text" name="etiquette" id="identification" value="">
<?php } ?> <br>
<div class="search-identification-result" style="display: none;"></div>
<label for="photo">Photo:</label>
      <input type="file" name="photo"><br><br>
     
        <input type="submit" name="submit" value="Enregistrer les modifications"> <br>
        <button type="submit" name="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?')">Supprimer mon post</button>

    </form>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function () {
  //...
  
  // Recherche d'identification
  $("#identification").keyup(function () {
    var identification = $(this).val();
    
    if (identification.startsWith("@")) {
      identification = identification.slice(1); // Enlève le @ du début
      
      if (identification != "") {
        $.ajax({
          type: "GET",
          url: "../controller/createPostController.php",
          data: {
            action: "search_identification",
            identification: encodeURIComponent(identification),
          },
          success: function (data) {
            $(".search-identification-result").show();
            $(".search-identification-result").html(data);
          },
          error: function (xhr, status, error) {
            console.log(error);
          },
        });
      } else {
        $(".search-identification-result").html("");
        $(".search-identification-result").hide();
      }
    }
  });

  // Recherche de lieu
  $("#lieu").keyup(function () {
    var lieu = $(this).val();
    
    if (lieu.startsWith("@")) {
      lieu = lieu.slice(1); // Enlève le @ du début
      
      if (lieu != "") {
        $.ajax({
          type: "GET",
          url: "../controller/createPostController.php",
          data: {
            action: "search_lieu",
            lieu: encodeURIComponent(lieu),
          },
          success: function (data) {
            $(".search-lieu-result").show();
            $(".search-lieu-result").html(data);
          },
          error: function (xhr, status, error) {
            console.log(error);
          },
        });
      } else {
        $(".search-lieu-result").html("");
        $(".search-lieu-result").hide();
      }
    }
  });
  
  // ...
});


$(document).ready(function () {
  
  $(document).on('click', '.search-identification-result li', function () {
    // Récupère le texte de l'élément cliqué et ajoute un "@" devant
    var selectedItem = $(this).text();
    // Modifie la valeur du champ "identification" avec le texte sélectionné
    $('#identification').val(selectedItem);
    $('.search-identification-result').hide();
  });

  $(document).on('click', '.search-lieu-result li', function () {
    // Récupère le texte de l'élément cliqué
    var selectedItem = $(this).text();
    $('#lieu').val(selectedItem);
    $('.search-lieu-result').hide();
  });

  // ...
});
</script>
<!-- <footer>
    <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
</footer> -->
</body>


</html>