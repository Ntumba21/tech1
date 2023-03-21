<?php
require_once '../models/suppression.php';
require_once '../views/supression.php';
require_once '../bdd/config.php';
require_once '../src/PHPMailer.php';
require_once '../src/SMTP.php';
require_once '../src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['mail'])) {
  $model = new Model();
  $user = $model->getUserByEmail($_POST['mail']);

  if($user) {
    $model->setUserInactive($user['iduser']);

    $mail = new PHPMailer(true);

    try {
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'ecebook.tech@gmail.com';
      $mail->Password   = 'ovexfyhnmrsyctyw';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->setFrom('ecebook.tech@gmail.com', 'EceBook');
      $mail->addAddress($user['mail']);

      $mail->isHTML(true);
      $mail->Subject = 'Your account is now inactive';
      $mail->Body = 'Bonjour<br><br>Votre compte sur EceBook a été marqué comme inactif. Si vous ne vous connectez pas dans les 60 prochaines secondes, votre compte sera définitivement supprimé<br>cliquez ici: <a href="http://localhost/EceBook/controllers/activationSup.php?activate=' . urlencode($user['mail']) . '&timestamp=' . time() . '">Activer mon compte</a><br>Cordialement,<br>EceBook';


      $mail->send();
      echo 'Un e-mail a été envoyé à ' . $user['mail'] . ' avec des instructions supplémentaires.';


         // Micro timer to delete user after 1 minute if not activated
         $seconds_to_wait = 60;
         $user = $model->getUserByEmail($_POST['mail']);
         if ($user && $user['isvalide'] == 0) {
           sleep($seconds_to_wait);
           $model->deleteUser($user['iduser']);
         }

    } catch (Exception $e) {
      echo 'Error: ' . $mail->ErrorInfo;
    }
  } else {
    echo 'L utilisateur avec le mail ' . $_POST['mail'] . ' n a pas été trouvé.';
  }
}
?>