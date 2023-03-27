<?php
require_once '../modele/Database.php';

require_once '../controller/src/PHPMailer.php';
require_once '../controller/src/SMTP.php';
require_once '../controller/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['mail'])) {
  $data = new Database();
  $user = $data->getUserByEmail($_POST['mail']);

  if($user) {
    $data->setUserInactive($user['iduser']);

    $mail = new PHPMailer(true);

    try {
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'EceBook.assistance@gmail.com';
      $mail->Password   = 'fgsdtlmyuzxsewpy';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->setFrom('EceBook.assistance@gmail.com', 'EceBook');
      $mail->addAddress($user['mail']);

      $mail->isHTML(true);
      $mail->Subject = 'Your account is now inactive';
      $mail->Body = 'Bonjour<br><br>Votre compte sur EceBook a été marqué comme inactif. Si vous ne vous connectez pas dans les 60 prochaines secondes, votre compte sera définitivement supprimé<br>cliquez ici: <a href="http://localhost/projet-tech/controller/activationMailSup.php?activate=' . urlencode($user['mail']) . '&timestamp=' . time() . '">Activer mon compte</a><br>Cordialement,<br>EceBook';


      $mail->send();
      echo 'Un e-mail a été envoyé à ' . $user['mail'] . ' avec des instructions supplémentaires.';


         // Micro timer pour supprimer un user au bout de 60 secondes si il n'est pas validé
         $seconds_to_wait = 60;
         sleep($seconds_to_wait);
         $user = $data->getUserByEmail($_POST['mail']);
         if ($user && $user['isvalide'] == 0) {
           $data->DeleteUserById($user['iduser']);
         }

    } catch (Exception $e) {
      echo 'Error: ' . $mail->ErrorInfo;
    }
  } else {
    echo 'L utilisateur avec le mail ' . $_POST['mail'] . ' n a pas été trouvé.';
  }
}
?>