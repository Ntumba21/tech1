<?php
require_once("../modele/database.php");
require_once("../controller/session.php");

// Vérifiez si la session est active, sinon redirigez l'utilisateur vers la page de connexion
//redirectToHome();

// Initialisez la variable pour stocker les messages d'erreur ou de succès
$message = "";

// Vérifiez si le formulaire a été soumis
if (isset($_POST['submit'])) {


  // Récupérez les données du formulaire
      $nom = $_POST["nom"];
      $prenom = $_POST["prenom"];
      $mail = $_SESSION["mail"];
      $date_de_naissance = $_POST["date_de_naissance"];
      $description = $_POST["description"];
      $ville = $_POST["ville"];
      $interests = $_POST["interests"];
      $idpromos = $_POST["idpromos"];
      $photo = null;
      if(isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        // Récupère le chemin de l'image temporaire
        $tmpFilePath = $_FILES['photo']['tmp_name'];

        // Crée un nom unique pour l'image
        $fileName = uniqid() . '-' . $_FILES['photo']['name'];

        // Déplace l'image vers le dossier des images
        $filePath = '../upload/avatar/'.$fileName;
        move_uploaded_file($tmpFilePath, $filePath);

        $photo = $filePath;
    }
  
 




  // Vérifiez si les champs obligatoires sont vides
  if (empty($nom) || empty($prenom) || empty($mail) || empty($date_de_naissance)) {
    $message = "Tous les champs marqués d'un astérisque (*) sont obligatoires.";
  } else {
    // Modifiez le profil de l'utilisateur dans la base de données
    $database = new Database();
    $result = $database->AlterUser($nom, $prenom, $mail,  $date_de_naissance, $description, $ville, $interests, $photo, $idpromos);

    if ($result) {
      $message = "Votre profil a été modifié avec succès.";
    } else {
      $message = "Une erreur s'est produite lors de la modification de votre profil. Veuillez réessayer.";
    }
  }
}

// Obtenez les informations sur l'utilisateur actuellement connecté
$database = new Database();
$user = $database->getUserByEmaill($_SESSION["mail"]);


