<?php
require_once ('..\controller\session.php ');
require_once ('..\modele\Database.php');
 

if(isset($_POST['mail']) && isset($_POST['password'])) {
 $db = new Database();
 $user = $db->Connect($_POST['mail'], $_POST['password']);
 if(count($user) > 0) {
    Session($user[0]["mail"], $user[0]["iduser"], true);
    //redirectToHome(); quand on aura le acceuilon decommente 
 $redirectUrl = "../view/profil.php"; // use an absolute path
 echo '<script>window.location.href = "'.$redirectUrl.'";</script>';
 } else {
 echo 'Identifiants incorrects ';
 }
}

?>