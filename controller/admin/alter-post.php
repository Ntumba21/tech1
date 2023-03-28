<?php
require_once ('..\..\modele\Database.php');
require_once ('..\..\controller\session.php');
echo 'hello word';
//TODO: faire ça
if (isset($_POST["submit"])){
    $type = $_POST["type"];
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $date = date("Y-m-d H:i:s");
    $lieu = $_POST['lieu'];
    $photo = null;
    $interests = $_POST['interet'];
    $etiquette = $_POST['identification'];
    $for = $_POST['for'];
    $link = $_POST['link'];
    $mail= $_SESSION['mail'];
    var_dump ($_POST);
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {

        // Récupère le chemin de l'image temporaire
        $tmpFilePath = $_FILES['photo']['tmp_name'];

        // Crée un nom unique pour l'image
        $fileName = uniqid() . '-' . $_FILES['photo']['name'];

        // Déplace l'image vers le dossier des images
        $filePath = '../../upload/post/' . $fileName;
        move_uploaded_file($tmpFilePath, $filePath);

        $photo = $filePath;

    }
    $data = new Database();
    $data->AlterAllPost($type, $titre, $contenu, $date, $lieu, $photo, $mail, $interests, $etiquette, $for, $link);


}else{
    $_SESSION['alert'] = 'Post pas ajouté';
}
