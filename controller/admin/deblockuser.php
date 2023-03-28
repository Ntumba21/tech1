<?php
require_once('..\..\modele\Database.php');
require_once('..\..\controller\session.php');
require_once 'mail-function.php';
$data = new Database();
if (isset($_POST['submit'])) {
    var_dump($_POST);
    foreach ($_POST['iduser'] as $iduser) {
        $result = $data-> setUserActive($iduser);
    }
    if ($result) {
        $message = "Bonjour, votre compte a été débloqué par l'administrateur du site EceBook. Vous pouvez désormais vous connecter à votre compte.";
        $sujet = "Déblocage de votre compte EceBook";
        AdminMail($_POST['email'],$sujet,$message);
         $_SESSION['alert'] = "Deblocage réussie";
    } else {
         $_SESSION['alert'] = "Deblocage échouée";
    }
    $_SESSION['redirection'] = 'admin/manage-user.php';
    header('Location: ../../view/alert.php');
}
