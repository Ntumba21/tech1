<?php
require_once '../models/User.php';

function activateAccount($email, $token) {
    $data=new database();
    $affectedRows = $data->activateAccount($email, $token);
    if ($affectedRows == 0) {
        print_r("Aucun utilisateur n'a été trouvé avec cet e-mail et ce token.");
    }
    return $affectedRows > 0;
}

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


