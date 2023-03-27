<?php
require_once('../modele/Database.php');
require_once('../controller/session.php');

$action = isset($_GET['action']) ? $_GET['action'] : null;

$rechercheModel = new Database();

if (isset($_GET['user'])) {
    $user = (string)trim($_GET['user']);
    $userId = $_SESSION['iduser']; 

    $resultats = $rechercheModel->rechercheAmis($user, $userId);

    if (count($resultats) > 0) {
        echo '<div class="result-search">';
        echo '<ul>';
        foreach ($resultats as $resultat) {
            echo '<li><a href="#" data-ami-id="' . $resultat['iduser'] . '">' . $resultat['nom'] . ' ' . $resultat['prenom'] . '</a></li>';
        }
        echo '</ul>';
        echo '</div>';
    }
}
?>
