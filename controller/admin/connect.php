<?php
    require_once ('..\..\modele\Database.php');
    require_once ('..\..\controller\session.php');


    if (isset($_POST['mail']) && isset($_POST['password'])) {
        $data = new Database();
        $mail = $_POST['mail'];
        $password = $_POST['password'];
    
        $admin = $data->ConnectAdmin($mail);
        if ($admin && password_verify($password, $admin['password'])) {
            Session($admin['mail'], $admin['password'], true);
            redirectToHomeAdmin();
        } else {
            $_SESSION['alert'] = "Utilisateur introuvable ou mot de passe incorrect";
            $_SESSION['redirection'] = 'admin/index.html';
            header('Location: ../../view/alert.php');
        }}
    ?>
