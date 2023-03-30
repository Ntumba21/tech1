<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/showuser.php");
//if(!VerifySession()){header('Location: index.html');}
require_once '../../modele/Database.php';
$data = new Database();
$post = $data->getPostById($_GET['idpost']);
$lieu = $data->getLieuByIdPost($_GET['idpost']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../view/admin/style/alter.css">

        </head>
        <h1>Modifer un Post</h1>
    <div class="textbox">


</div>
<div class="container">
<div class="form">
            <form action="../../controller/admin/alter-post.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id-post" value="<?php echo $_GET['idpost']; ?>">
                <label for="type">Type</label>
                <select name="type" id="type">
                    <option value="1">Actualités</option>
                    <option value="2">Événements</option>
                    <option value="3">Général</option>
                </select>
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" value="<?php echo $post['titre']; ?>">
                <label for="contenu">Contenu</label>
                <textarea name="contenu" id="contenu" cols="30" rows="10"><?php echo $post['contenu']; ?></textarea>
                <label for="lieu">Lieu</label>
                <input type="text" name="lieu" id="lieu" value="<?php echo $lieu['lieu_nom']; ?>">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo">
                <label for="for">Pour</label>
                <select name="for" id="for">
                    <option value="0">Tout le monde</option>
                    <option value="1">Les étudiants</option>
                    <option value="2">Les enseignants</option>
                    <option value="3">Les entreprises</option>
                </select>
                <label for="interet">interet</label>
                <input type="text" name="interet" id="interet">
                <label for="link">link</label>
                <input type="text" name="link" id="link">
                
                <input type="submit" name="submit" value="Modifier">
            </form>
        </section>
    </main>
</body>
</html>