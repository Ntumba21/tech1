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
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <!-- header section start -->



    

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
<option value="actualités">Actualités</option>
    <option value="événements">Événements</option>
    <option value="général">Général</option>
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
<input type="text" name="lieu" value="<?php echo $post['lieu']; ?>">
<?php } else { ?>
<input type="text" name="lieu" value="">
<?php } ?> <br>



etiquette:
<?php if(isset($post['etiquette'])) { ?>
<input type="text" name="etiquette" value="<?php echo $post['etiquette']; ?>">
<?php } else { ?>
<input type="text" name="etiquette" value="">
<?php } ?> <br>
<label for="photo">Photo:</label>
      <input type="file" name="photo"><br><br>
     
        <input type="submit" name="submit" value="Enregistrer les modifications"> <br>
        <button type="submit" name="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?')">Supprimer mon post</button>

    </form>
</div>
</div>
</body>
</html>