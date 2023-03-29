<?php
require_once("../modele/database.php");
require_once("../controller/session.php");
require_once '../controller/src/PHPMailer.php';
require_once '../controller/src/SMTP.php';
require_once '../controller/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Vérifiez si la session est active, sinon redirigez l'utilisateur vers la page de connexion
//redirectToHome();
$id= $_SESSION["iduser"];
$mail= $_SESSION['mail'];
function sendActivationEmail($identifier) {
    $mail = new PHPMailer(true);
  
    try {
        // Paramètres du serveur
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Remplacez par l'hôte de votre serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'EceBook.assistance@gmail.com'; // Remplacez par votre adresse e-mail
        $mail->Password = 'fgsdtlmyuzxsewpy'; // Remplacez par le mot de passe de votre e-mail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
  
        // Destinataires
        $mail->setFrom('EceBook.assistance@gmail.com', 'EceBook'); // Remplacez par votre adresse e-mail et le nom de l'expéditeur
        $mail->addAddress($identifier);
  
        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Identification post';
        $mail->Body = 'Vous avez été identidié dans ce post: <a href="http://localhost/projet-tech/facebookk/notification.php?email=' . urlencode($identifier) . '">Voir le poste</a>';
  
        $mail->send();
        return true;    
    } catch (Exception $e) {
        return false;
    }
  }
  
    if (isset($_GET['identification'])) {
      $identification = trim($_GET['identification']);
  
      $data = new Database();
      $resultats = $data->rechercherUtilisateursParIdentification($identification,$id);
  
      if (count($resultats) > 0) {
        echo '<div class="result-search">';
        echo '<ul>';
        foreach ($resultats as $resultat) {
          echo '<li>' . $resultat['nom']. '</li>';
        }
        echo '</ul>';
        echo '</div>';
      }
    }
  
  
    if (isset($_GET['lieu'])) {
      $lieu = trim($_GET['lieu']);
  
      $data = new Database();
      $resultats = $data->rechercherLieux($lieu);
  
      if (count($resultats) > 0) {
        echo '<div class="result-search">';
        echo '<ul>';
        foreach ($resultats as $resultat) {
          echo '<li>' . $resultat['lieu'] . '</li>';
        }
        echo '</ul>';
        echo '</div>';
     
      }
    }
  
  $data = new Database();
$database = new Database();


if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $idpost = isset($_POST['idpost']) ? $_POST['idpost'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $contenu = isset($_POST['contenu']) ? $_POST['contenu'] : '';
    $date = date("Y-m-d H:i:s");
    $lieu = isset($_POST['lieu']) ? $_POST['lieu'] : '';
    $photo = isset($_POST['photo']) ? $_POST['photo'] : '';
    $iduser = isset($_POST['iduser']) ? $_POST['iduser'] : '';
    $etiquette = isset($_POST['identification']) ? $_POST['identification'] : '';
    
    $id= $_SESSION["iduser"];
    // Appel à la fonction alterPost
    $result = $database->alterPost($idpost, $type, $titre, $contenu, $date, $lieu, $photo, $iduser, $etiquette);
    $identifie = $data->getUserByNom($etiquette);
    //sendActivationEmail($identifie['mail']);
    $_SESSION['userident'] = $identifie['iduser'];

    // Vérification du résultat de la mise à jour
    if ($result === "success") {
        echo "Le post a été mis à jour avec succès.";
    } else {
        echo "La mise à jour du post a échoué.";
    }
} 
else if (isset($_POST['delete'])) {
    // Récupération de l'ID du post à supprimer
    $idpost = isset($_POST['idpost']) ? $_POST['idpost'] : '';

   
        // Appel à la fonction deletePost
        $result = $database->DeletePost($idpost);

        // Vérification du résultat de la suppression
        if ($result) {
            echo "Le post a été supprimé avec succès.";
        } else {
            echo "La suppression du post a échoué.";
        }
    }
 else {
    // Récupération de l'ID du post à modifier
    $idpost = isset($_GET['idpost']) ? $_GET['idpost'] : '';
 
    // Récupération des informations du post à partir de l'ID
    $post = $database->getPostById($idpost);

    // Affichage de la vue
    // require_once '../view/editpost.php';
}
?>