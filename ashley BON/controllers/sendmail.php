<?php

require_once '../bdd/config.php';
require_once '../src/PHPMailer.php';
require_once '../src/SMTP.php';
require_once '../src/Exception.php';

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
        $mail->Username = 'ecebook.tech@gmail.com'; // Remplacez par votre adresse e-mail
        $mail->Password = 'ovexfyhnmrsyctyw'; // Remplacez par le mot de passe de votre e-mail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Destinataires
        $mail->setFrom('ecebook.tech@gmail.com', 'EceBook'); // Remplacez par votre adresse e-mail et le nom de l'expéditeur
        $mail->addAddress($email);

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Activation de votre compte EceBook';
        $mail->Body = 'Cliquez sur ce lien pour activer votre compte: <a href="http://localhost/EceBook/controllers/activation.php?email=' . urlencode($email) . '&token=' . urlencode($token) . '">Activer mon compte</a>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
