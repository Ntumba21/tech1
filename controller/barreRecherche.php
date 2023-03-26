<?php
require_once('../modele/Database.php');
require_once('../controller/session.php');

$action = isset($_GET['action']) ? $_GET['action'] : null;

$rechercheModel = new Database();

if ($action == 'ajouterAmi') {
    $userId = $_SESSION['iduser']; // Correction ici
    $amiId = (int) $_GET['ami_id'];

    $rechercheModel->ajouterAmi($userId, $amiId);
} 
    // Recherche d'utilisateur
    else if (isset($_GET['user'])) {
        $user = (string)trim($_GET['user']);

        $resultats = $rechercheModel->rechercherUtilisateur($user);

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
