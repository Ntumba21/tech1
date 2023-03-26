<?php
require_once("../modele/database.php");
require_once("../controller/session.php");

// Vérifiez si la session est active, sinon redirigez l'utilisateur vers la page de connexion
//redirectToHome();

// Initialisez la variable pour stocker les messages d'erreur ou de succès
$mail= $_SESSION['mail'];

// Vérifiez si le formulaire a été soumis
if (isset($_POST['submit'])) {


  // Récupérez les données du formulaire
      $description = $_POST["description"];
      $ville = $_POST["ville"];
      $interests = $_POST["interests"];
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
 
    // Modifiez le profil de l'utilisateur dans la base de données
    $database = new Database();
    $result = $database->AlterUser($description, $ville, $interests, $photo,$mail);

    if ($result) {
        $_SESSION['alert'] = "Votre profil a été modifié avec succès.";
    } else {
        $_SESSION['alert'] = "Une erreur s'est produite lors de la modification de votre profil. Veuillez réessayer.";
    }
    $_SESSION['redirection'] = 'profil.php';
    header('Location: ../view/alert.php');
}
  


