<?php
require_once('../modele/Database.php');

if (isset($_GET['user'])) {
    $user = (string) trim($_GET['user']);

    $rechercheModel = new Database();
    $resultats = $rechercheModel->rechercherUtilisateur($user);

    if (count($resultats) > 0) {
        echo '<div class="result-search">';
        echo '<h2>Résultats de recherche :</h2>';
        echo '<ul>';
        foreach ($resultats as $resultat) {
            echo '<li><a href="#">' . $resultat['nom'] . ' ' . $resultat['prenom'] . '</a></li>';
        }
        echo '</ul>';
        echo '</div>';
    }
}
?>
