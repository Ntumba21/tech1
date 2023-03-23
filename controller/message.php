<?php

require_once '../modele/Database.php';

$messageController = new Database($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $iduser = $_POST['iduser'];
    $idamis = $_POST['idamis'];
    $contenu = $_POST['message'];

    if (!empty($contenu)) {
        $result = $messageController->sendMessage($iduser, $idamis, $contenu);

        if ($result) {
            // Rediriger vers la page de chat si le message a été envoyé avec succès.
            header('Location: chat.php');
            exit();
        } else {
            // Gérer l'erreur si le message n'a pas pu être envoyé.
            echo 'Erreur lors de l\'envoi du message.';
        }
    } else {
        // Gérer l'erreur si le contenu du message est vide.
        echo 'Le message ne doit pas être vide.';
    }
} else {
    // Rediriger vers la page de chat si la requête n'est pas une requête POST.
    header('Location: chat.php');
    exit();
}


?>