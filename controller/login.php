<?php
require_once ('..\controller\session.php ');
require_once ('..\modele\Database.php');
 //session_start();


if(isset($_POST['mail']) && isset($_POST['password'])) {
 $db = new Database();
 $user = $db->Connect($_POST['mail'], $_POST['password']);
 if(count($user) > 0) {
 Session($user[0]["mail"], $user[0]["iduser"], true);
 redirectToHome();
 } else {
 echo 'Identifiants incorrects ';
 }
}

?>