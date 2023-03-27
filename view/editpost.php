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

var_dump($post)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT POST </title>
</head>
<body>
    
</body>
</html>
<div class="createPost">
    <h3 class="mini-headign">Modifier Post</h3>
    <form action="../controller/editpostuser.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idpost" value="<?php echo $post['idpost']; ?>">
        
   titre:
    <?php if(isset($post['titre'])) { ?>
<input type="text" name="titre" value="<?php echo $post['titre']; ?>">
<?php } else { ?>
<input type="text" name="titre" value="">
<?php } ?>

contenu:
<?php if(isset($post['contenu'])) { ?>
<textarea name="contenu"><?php echo $post['contenu']; ?></textarea>
<?php } else { ?>
<textarea name="contenu"></textarea>
<?php } ?>

date:
jj/mm/aaaa
<br />
<?php if(isset($post['date'])) { ?>
<input type="text" name="date" value="<?php echo $post['date']; ?>">
<?php } else { ?>
<input type="text" name="date" value="">
<?php } ?>

lieu:
<?php if(isset($post['lieu'])) { ?>
<input type="text" name="lieu" value="<?php echo $post['lieu']; ?>">
<?php } else { ?>
<input type="text" name="lieu" value="">
<?php } ?>



etiquette:
<?php if(isset($post['etiquette'])) { ?>
<input type="text" name="etiquette" value="<?php echo $post['etiquette']; ?>">
<?php } else { ?>
<input type="text" name="etiquette" value="">
<?php } ?>
<label for="photo">Photo:</label>
      <input type="file" name="photo"><br><br>
        <input type="submit" name="submit" value="Enregistrer les modifications">
    </form>
</div>
