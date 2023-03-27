<?php
require_once '../modele/Database.php';

require_once '../controller/src/PHPMailer.php';
require_once '../controller/src/SMTP.php';
require_once '../controller/src/Exception.php';
require_once 'session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$db=new Database();

function sendActivationEmail($email) {
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
        $mail->Subject = 'Réinitialisation de votre mot de passe';
        $mail->Body = 'Cliquez sur ce lien pour réinitialiser votre mot de passe: <a href="http://localhost/projet-tech/view/pageReinitialisation.php?email=' . urlencode($email) . '">Réinitialiser mon mot de passe</a>';

        $mail->send();
        return true;    
    } catch (Exception $e) {
        return false;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['mail'];
    $verif=$db->checkEmailExists($email);
    if ($verif) {
        if (sendActivationEmail($email)) {
            echo "Veuillez vérifier votre e-mail pour réinitialiser votre mot de passe.";
        } else {
            echo "Erreur lors de l'envoi de l'e-mail de réinitialisation. Veuillez contacter l'administrateur.";
        }
    } else {
        echo "Cette adresse e-mail n'existe pas. Veuillez vérifier votre saisie.";
    }
}
?>