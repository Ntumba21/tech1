<?php
require_once '../modele/Database.php';

require_once '../controller/src/PHPMailer.php';
require_once '../controller/src/SMTP.php';
require_once '../controller/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendActivationEmail($email, $token) {
    $mail = new PHPMailer(true);

    try {
        // Paramètres du serveur
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Remplacez par l'hôte de votre serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'EceBook.assistance@gmail.com'; // Remplacez par votre adresse e-mail
        $mail->Password = 'fgsdtlmyuzxsewpy'; // Remplacez par le mot de passe de votre e-mail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Destinataires
        $mail->setFrom('EceBook.assistance@gmail.com', 'EceBook'); // Remplacez par votre adresse e-mail et le nom de l'expéditeur
        $mail->addAddress($email);

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Activation de votre compte EceBook';
        $mail->Body = 'Cliquez sur ce lien pour activer votre compte: <a href="http://localhost/projet-tech/controller/activationMailRegister.php?email=' . urlencode($email) . '&token=' . urlencode($token) . '">Activer mon compte</a>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

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
    $data = new Database();
    $result = $data->createUser($nom, $prenom, $mail, $password, $date_de_naissance, $type, $description, $ville, $interests, $photo, $isvalide, $token);

    if ($result) {
        $data->registerPromo($mail,$idpromos);
        if (sendActivationEmail($mail, $token)) {
            echo "Utilisateur créé avec succès. Veuillez vérifier votre e-mail pour activer votre compte.";
            $data->defaultFriend($mail,$idpromos);
        } else {
            echo "Erreur lors de l'envoi de l'e-mail d'activation. Veuillez contacter l'administrateur.";
        }
} else {
    echo "Erreur lors de la création de l'utilisateur.";
}


}

