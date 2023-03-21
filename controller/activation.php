<?php
require_once '../models/User.php';

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    $user = new User();
    $result = $user->activateAccount($email, $token);

    if ($result) {
        echo "Votre compte a été activé avec succès.";
    } else {
        echo "Erreur lors de l'activation de votre compte. Veuillez vérifier le lien d'activation ou contacter l'administrateur.";
    }
} else {
    echo "Paramètres d'activation manquants.";
}
?>


