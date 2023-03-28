<?php
    require_once ('..\..\modele\Database.php');
    require_once ('..\..\controller\session.php');
    require_once 'mail-function.php';
    $data = new Database();
    if(isset($_POST['submit'])){
        var_dump($_POST);
        foreach ($_POST['iduser'] as $iduser){
            $result = $data->DeleteUserById($iduser);
        }
        if($result){
            $message = "Bonjour, votre compte a été supprimé par l'administrateur du site EceBook. Pour plus d'informations, veuillez contacter l'administrateur du site.";
            $sujet = "Suppression de votre compte EceBook";
            AdminMail($_POST['email'],$sujet,$message);
            echo $_SESSION['alert'] = "Suppression réussie";
        }else{
            echo $_SESSION['alert']="Suppression échouée";
        }
        $_SESSION['redirection'] = 'admin/manage-user.php';
        header('Location: ../../view/alert.php');
    }
       
