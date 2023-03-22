<?php
require_once '../models/suppression.php';
require_once '../controllers/supression.php';

if(isset($_GET['activate']) && isset($_GET['timestamp'])) {
  $data = new Database();
  $user = $data->getUserByEmail($_GET['activate']);

  if($user) {
    if($user['isvalide'] == 0 && (time() - $_GET['timestamp'] <= 60)) {
      $data->setUserActive($user['iduser']);
      echo 'Votre compte est réactivé.';
    } else {
      $data->DeleteUserById($user['iduser']);
      echo 'Votre compte a été supprimé.';
    }
  } else {
    echo 'L utilisateur avec le mail: ' . $_GET['activate'] . ' n a pas été trouvé.';
  }
}

?> 
