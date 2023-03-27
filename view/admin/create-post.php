<?php require_once '../../controller/session.php';
//pour verifier si la session est valide
//if(!VerifySession()){header('Location: index.html');} ?>
<!DOCTYPE html>
<html>
    <section class="createPost">
    <h1>Ajouter un Post</h1>
    <form name="ajouter-post" method="post" action="../../controller/admin/post.php">
        <input type="hidden" name="action" value="create">
        <label for="type">Type :</label>
        <select name="type" id="type">
            <option value="actualités">Actualités</option>
            <option value="événements">Événements</option>
            <option value="général">Général</option>
        </select><br>
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre"><br>
        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu"></textarea><br>
        <label for="date">Date :</label>
        <input type="date" name="date" id="date"><br>
        <label for="lieu">Nom du lieu :</label>
        <input type="text" name="lieu" id="lieu"><br>
        <label for="adresse_lieu">Adresse du lieu :</label>
        <input type="text" name="adresse_lieu" id="adresse_lieu"><br>
        <label for="identification">Identification</label>
        <input type="text" name="identification" id="identification"><br>
        <label for="photo">Photo :</label>
        <input type="file" name="photo" id="photo"><br>
        <label for="for">Pour :</label>
        <select name="for" id="for">
            <option value="0">Tous</option>
            <option value="1">Eleve</option>
            <option value="2">Professeur</option>
        </select><br>
        <button type="submit" name="Create-post">Publier</button>
    </form>
</section>
</html>

