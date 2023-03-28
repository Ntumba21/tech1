<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/showuser.php");
//if(!VerifySession()){header('Location: index.html');}?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../view/style/manage.css">
</html>
<body>
    <main>
        <section>
            <h1> Modifier un post </h1>
            <form action="../../controller/admin/alter-post.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $_GET['idpost']; ?>">
                <label for="type">Type</label>
                <select name="type" id="type">
                    <option value="1">Evenement</option>
                    <option value="2">Article</option>
                    <option value="3">Offre</option>
                    <option value="4">Demande</option>
                </select>
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" value="<?php echo $post['titre']; ?>">
                <label for="contenu">Contenu</label>
                <textarea name="contenu" id="contenu" cols="30" rows="10"><?php echo $post['contenu']; ?></textarea>
                <label for="lieu">Lieu</label>
                <input type="text" name="lieu" id="lieu" value="<?php echo $post['lieu']; ?>">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo">
                <label for="for">Pour</label>
                <select name="for" id="for">
                    <option value="1">Tout le monde</option>
                    <option value="2">Les étudiants</option>
                    <option value="3">Les enseignants</option>
                    <option value="4">Les entreprises</option>
                </select>
                <input type="submit" name="submit" value="Modifier">
