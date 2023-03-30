<?php
require_once('../modele/Database.php');
require_once('../controller/session.php');

require_once '../controller/src/PHPMailer.php';
require_once '../controller/src/SMTP.php';
require_once '../controller/src/Exception.php';
require_once 'session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$id= $_SESSION["iduser"];


function sendActivationEmail($identifier) {
  $mail = new PHPMailer(true);

  try {
      // Paramètres du serveur
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com'; // Remplacez par l'hôte de votre serveur SMTP
      $mail->SMTPAuth = true;
      $mail->Username = 'ece.book.assistance08@gmail.com'; // Remplacez par votre adresse e-mail
      $mail->Password = 'bvwnmsqirbfhlafj'; // Remplacez par le mot de passe de votre e-mail
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      // Destinataires
      $mail->setFrom('ece.book.assistance08@gmail.com', 'EceBook'); // Remplacez par votre adresse e-mail et le nom de l'expéditeur
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
    $resultats = $data->rechercheAmis($identification,$id);

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
  if(isset($_POST['action']) && $_POST['action'] == 'create') {
    if(isset($_POST['type']) && isset($_POST['titre']) && isset($_POST['contenu']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['identification'])) {
      $type = $_POST['type'];
      $titre = $_POST['titre'];
      $contenu = $_POST['contenu'];
      $date = date("Y-m-d H:i:s");
      $lieu = $_POST['lieu'];
      $etiquette = $_POST['identification'];
      $photo = null;
      
      // Vérifie si une image a été ajoutée
      if(isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        // Récupère le chemin de l'image temporaire
        $tmpFilePath = $_FILES['photo']['tmp_name'];
        
        // Crée un nom unique pour l'image
        $fileName = uniqid() . '-' . $_FILES['photo']['name'];
        
        // Déplace l'image vers le dossier des images
        $filePath = '../upload/post/' . $fileName;
        move_uploaded_file($tmpFilePath, $filePath);
        
        $photo = $filePath;
      }
      $id= $_SESSION["iduser"];
      // Ajoute le post à la base de données
      $data->CreatePost($type, $titre, $contenu, $date, $lieu, $photo,$id,$etiquette);


      $identifie = $data->getUserByNom($etiquette);
      sendActivationEmail($identifie['mail']);
      $_SESSION['userident'] = $identifie['iduser'];
      
      // Redirige vers la page d'accueil
      header('Location: ../facebookk/index.php');
      exit();
    }
  }

 

?>
