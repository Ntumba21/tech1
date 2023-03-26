<?php
require_once('..\..\modele\Database.php');
require_once('..\..\controller\session.php');
$data = new Database();
if (isset($_POST['submit'])) {
    foreach ($_POST['iduser'] as $iduser) {
        $result = $data-> BlockUser($iduser);
    }
    if ($result) {
         $_SESSION['alert'] = "Blocage réussie";
    } else {
         $_SESSION['alert'] = "Blocage échouée";
    }
    $_SESSION['redirection'] = 'admin/manage-user.php';
}

