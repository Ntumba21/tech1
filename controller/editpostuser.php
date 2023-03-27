<?php
require_once("../modele/database.php");
require_once("../controller/session.php");

// Vérifiez si la session est active, sinon redirigez l'utilisateur vers la page de connexion
//redirectToHome();

$mail= $_SESSION['mail'];
$database = new Database();


if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $idpost = isset($_POST['idpost']) ? $_POST['idpost'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $contenu = isset($_POST['contenu']) ? $_POST['contenu'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $lieu = isset($_POST['lieu']) ? $_POST['lieu'] : '';
    $photo = isset($_POST['photo']) ? $_POST['photo'] : '';
    $iduser = isset($_POST['iduser']) ? $_POST['iduser'] : '';
    $etiquette = isset($_POST['etiquette']) ? $_POST['etiquette'] : '';

    // Appel à la fonction alterPost
    $result = $database->alterPost($idpost, $type, $titre, $contenu, $date, $lieu, $photo, $iduser, $etiquette);

    // Vérification du résultat de la mise à jour
    if ($result) {
        echo "Le post a été mis à jour avec succès.";
    } else {
        echo "La mise à jour du post a échoué.";
    }
} else {
    // Récupération de l'ID du post à modifier
    $idpost = isset($_GET['idpost']) ? $_GET['idpost'] : '';

    // Récupération des informations du post à partir de l'ID
    $post = $database->getPostById($idpost);

    // Affichage de la vue
    // require_once '../view/editpost.php';
}
?>