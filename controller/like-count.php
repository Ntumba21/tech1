<?php
require_once('..\modele\Database.php');

if (isset($_GET['idpost'])) {
    $idpost = $_GET['idpost'];
    $mail = $_SESSION['mail'];

    $db = new Database();
    $nblike = $db->CountLike($idpost);

    // Vérifier si l'utilisateur a déjà aimé ce post
    if (!$db->hasLikedPost($idpost, $mail)) {
        echo $nblike;
    } else {
        echo "already liked";
    }
}

?>