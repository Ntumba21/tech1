<?php
//require_once '../controller/session.php';
require_once '../modele/Database.php';


// Si l'utilisateur est déjà connecté, le rediriger vers la page d'accueil
 if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    redirectToHome();
}

// Si le formulaire a été soumis
if (isset($_POST['email'])&& $_POST['password']){
    $Data = new Database();
    $users = $Data->Connect($_POST['email'], md5($_POST['password']));
        if  (count($users) >0){
            print_r ($users);
            //Session($users[0]["mail"],$users[0]["iduser"],true);
             //Si les identifiants sont valides, connecter l'utilisateur
           // redirectToHome(); // la page va nous rediriger 
           echo"okkkkkkkkkkkkkkkkkk";
        }else{
            // Si les identifiants sont invalides, afficher un message d'erreur
            echo "pas d'utilisateur";
            $errorMessage = "Mail ou mot de passe incorrect";
           
        }


}
?>