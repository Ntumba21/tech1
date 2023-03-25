<?php
require_once ('..\controller\session.php ');
require_once ('..\modele\Database.php');
 

if(isset($_POST['email']) && isset($_POST['password'])) {
 $db = new Database();
 $user = $db->Connect($_POST['email'], $_POST['password']);
 if(count($user) > 0 && password_verify($_POST['password'], $user[0]['password'])) {
    Session($user[0]["mail"], $user[0]["iduser"], true);
    //redirectToHome(); 
 $redirectUrl = "../view/profil.php"; // use an absolute path
 echo '<script>window.location.href = "'.$redirectUrl.'";</script>';
 } else {
    $_SESSION['alert'] = 'Identifiants incorrects ';
     header('Location: ../view/alert.php');
 }
}

