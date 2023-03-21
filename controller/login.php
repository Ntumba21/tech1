<?php
require_once '../controller/session.php';
require_once '../modele/Database.php';


// Vérifier si le formulaire a été soumis
if(isset($_POST['mail'])&& $_POST['password']) {
   // Instancier l'objet Database pour accéder à la base de données
        $db = new Database();

        // Vérifier si les identifiants sont corrects
        $user = $db->Connect($_POST['mail'], $_POST['password']);

        // Si les identifiants sont corrects, créer une session et rediriger l'utilisateur vers la page appropriée
        if(count ( $user) >0) {
           
            redirectToHome();
        } 
    } else {
        echo "pas d'utilisateur";
    }



?>