<?php
require_once ('..\..\modele\Database.php');
require_once ('..\..\controller\session.php');
//TODO: faire ça
if (isset($_POST["submit"])){
    $idpost = $_POST["id-post"];
    $type = $_POST["type"];
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $date = date("Y-m-d H:i:s");
    $lieu = $_POST['lieu'];
    $photo = null;
    $interests = $_POST['interet'];
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
//    $data->AlterAllPost($idpost, $titre, $contenu, $date, $photo, $interests, $etiquette, $for, $link,$lieu);
    $_SESSION['alert'] = 'Post ajouté';

}else{
    $_SESSION['alert'] = 'Post pas ajouté';
}
$_SESSION['redirection'] = '../view/admin/alter-post.php?idpost='.$idpost;
//header('Location: ../../view/alert.php');
