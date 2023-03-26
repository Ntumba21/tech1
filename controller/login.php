<?php
require_once ('..\controller\session.php ');
require_once ('..\modele\Database.php');
 

if(isset($_POST['email']) && isset($_POST['password'])) {
 $db = new Database();
 $user = $db->Connect($_POST['email'], $_POST['password']);
 if(count($user) > 0) {
    Session($user[0]["mail"], $user[0]["iduser"], true);
    //redirectToHome(); 
 //$redirectUrl = "../facebookk/profil.php"; // use an absolute path
 //echo '<script>window.location.href = "'.$redirectUrl.'";</script>';
 $redirectUrl = "../facebookk/index.php"; // use an absolute path
 echo '<script>window.location.href = "'.$redirectUrl.'";</script>';
 } else {
    $_SESSION['alert'] = 'Identifiants incorrects ';
     $_SESSION['redirection'] = 'loginform.php';
     header('Location: ../view/alert.php');
 }
}

