<?php
require_once('..\..\modele\Database.php');
require_once('..\..\controller\session.php');
require_once 'mail-function.php';
$data = new Database();
if (isset($_POST['submit'])) {
    var_dump($_POST);
    foreach ($_POST['iduser'] as $iduser) {
        $result = $data-> setUserInactive($iduser);
    }
    if ($result) {

         $_SESSION['alert'] = "Blocage réussie";
         $message = "Bonjour, votre compte a été bloqué par l'administrateur du site EceBook. Pour plus d'informations, veuillez contacter l'administrateur du site.";
         $sujet = "Blocage de votre compte EceBook";
         AdminMail($_POST['email'],$sujet,$message);
    } else {
         $_SESSION['alert'] = "Blocage échouée";
    }
    $_SESSION['redirection'] = 'admin/manage-user.php';
//    header('Location: ../../view/alert.php');
}


