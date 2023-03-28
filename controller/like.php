<?php
require_once('../modele/Database.php');
require_once ('../controller/session.php ');



if (isset($_POST['idpost'])) {
    $idpost = $_POST['idpost'];
    $mail = $_SESSION['mail'];

    $db = new Database();

    // Vérifier si l'utilisateur a déjà aimé ce post
    if (!$db->hasLikedPost($idpost, $mail)) {
        $like = 1; // ou 2 pour un dislike
        $db->likes($idpost, $mail, $like);
    }
}


?>
