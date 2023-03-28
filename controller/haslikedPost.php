<?php
require_once('../modele/Database.php');

if (isset($_GET['idpost'])) {
    $idpost = $_GET['idpost'];
    $email = $_SESSION['mail'];

    $db = new Database();
    $hasLikedPost = $db->hasLikedPost($idpost, $email);

    echo $hasLikedPost ? 'true' : 'false';
}
?>