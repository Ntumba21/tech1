<?php
require_once ('..\controller\tools.php');
require_once ('..\modele\Database.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $date_de_naissance = $_POST['date_de_naissance'];
            $type = $_POST['type'];
            $description = $_POST['description'];
            $ville = $_POST['ville'];
            $interests = $_POST['interests'];
            $photo = $_POST['photo'];
            $isvalide = 1;
            $idpromos = $_POST['idpromos'];
        
            // Valider le mot de passe
            if (!validatePassword($password)) {
                echo "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, un chiffre et un caractère spécial.";
                exit;
            }
        
            // Valider l'email
            if (!validateEmail($mail, $type)) {
                echo "L'adresse e-mail n'est pas valide.";
                exit;
            }
        
            // Créer un nouvel utilisateur
            $user = new Database;
            $result = $user->createUser($nom, $prenom, $mail, $password, $date_de_naissance, $type, $description, $ville, $interests, $photo, $isvalide, $idpromos);
        
            if ($result) {
                echo "Utilisateur créé avec succès.";
            } else {
                echo "Erreur lors de la création de l'utilisateur.";
            }
}