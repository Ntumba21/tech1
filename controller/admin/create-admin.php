<?php
require_once ('..\..\modele\Database.php');
require_once ('..\..\controller\session.php');
if(isset($_POST['submit'])){
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    //cryptage du mot de passe
    var_dump($_POST);
   $password = password_hash($password, PASSWORD_DEFAULT);
    var_dump($password);
    $data = new Database();
    $result = $data->createAdmin($nom, $email, $password);
    if($result){
        $_SESSION['alert'] = "Admin ajouté";
    }else{
        $_SESSION['alert'] = "Admin non ajouté";
    }
//    $_SESSION['redirection'] = 'admin/manage-admin.php';
//    header('Location: ../../view/alert.php');
}
