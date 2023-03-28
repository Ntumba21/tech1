<?php
    require_once ('..\..\modele\Database.php');
    require_once ('..\..\controller\session.php');
    $data = new Database();
    if(isset($_POST['submit'])){
        var_dump($_POST);
        foreach ($_POST['iduser'] as $iduser){
            $result = $data->DeleteUserById($iduser);
        }
        if($result){
            echo $_SESSION['alert'] = "Suppression réussie";
        }else{
            echo $_SESSION['alert']="Suppression échouée";
        }
        $_SESSION['redirection'] = 'admin/manage-user.php';
        header('Location: ../../view/alert.php');
    }
       
