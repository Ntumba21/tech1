<?php
require_once('../modele/Database.php');
require_once('../controller/session.php');

  function create() {
    if(isset($_POST['type']) && isset($_POST['titre']) && isset($_POST['contenu']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['identification'])) {
      $type = $_POST['type'];
      $titre = $_POST['titre'];
      $contenu = $_POST['contenu'];
      $date = $_POST['date'];
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
     $data = new Database();
      // Ajoute le post à la base de données
      $data->CreatePost($type, $titre, $contenu, $date, $lieu, $photo,$id,$etiquette);

      // Redirige vers la page d'accueil
      header('Location: ../facebookk/index.php');
      exit();
    }
  }

if(isset($_POST['action']) && $_POST['action'] == 'create') {
  create();
}
?>
