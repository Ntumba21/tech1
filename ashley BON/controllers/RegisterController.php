<?php
require_once '../models/User.php';

function validatePassword($password) {
    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    return preg_match($pattern, $password);
}

function validateEmail($email, $type) {
    if ($type == 1) {
        $pattern = '/^[a-zA-Z0-9._%+-]+@edu\.ece\.fr$/';
    } elseif ($type == 2) {
        $pattern = '/^[a-zA-Z0-9._%+-]+@(ece\.fr|omnesintervenant\.com)$/';
    } else {
        return false;
    }
    return preg_match($pattern, $email);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $date_de_naissance = $_POST['date_de_naissance'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $ville = $_POST['ville'];
    $interests = $_POST['interests'];
    $photo = $_POST['photo'];
    $isvalide = 0;
    $idpromos = $_POST['idpromos'];
    $token = bin2hex(random_bytes(32));
    

    // Valider le mot de passe
    if (!validatePassword($password)) {
        echo "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, un chiffre et un caractère spécial.";
        exit;
    }

    // Valider l'email
    if (!validateEmail($mail, $type)) {
        echo "L'adresse e-mail n'est pas valide.";
        exit;
    }

    // Créer un nouvel utilisateur
    $user = new User();
$result = $user->createUser($nom, $prenom, $mail, $password, $date_de_naissance, $type, $description, $ville, $interests, $photo, $isvalide, $idpromos, $token);
$user->closeConnection();

if ($result) {
    require_once '../controllers/sendmail.php';
    if (sendActivationEmail($mail, $token)) {
        echo "Utilisateur créé avec succès. Veuillez vérifier votre e-mail pour activer votre compte.";
    } else {
        echo "Erreur lors de l'envoi de l'e-mail d'activation. Veuillez contacter l'administrateur.";
    }
} else {
    echo "Erreur lors de la création de l'utilisateur.";
}


}
?>
