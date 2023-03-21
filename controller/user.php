<?php

namespace controller;

use Database;

require_once ('..\modele\Database.php');
require_once ('..\controller\tools.php');

class user{
    public $name;
    public $firstname;
    public $mail;
    public $type;
    public $photo;

    public function MakeUser($mail){
        $user = new Database;
        $result = $user->GetUser($mail);
        $this->name = $result[0]['nom'];
        $this->firstname = $result[0]['prenom'];
        $this->mail = $result[0]['mail'];
        $this->type = $result[0]['type'];
        $this->photo = $result[0]['photo'];
    }

    public function getName(){return $this->name;}
    public function getFirstname(){return $this->firstname;}
    public function getMail(){return $this->mail;}
    public function getType(){return $this->type;}
    public function getPhoto(){return $this->photo;}

//    public function register(){
//        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            // Récupérer les données du formulaire
//            $nom = $_POST['nom'];
//            $prenom = $_POST['prenom'];
//            $mail = $_POST['mail'];
//            $password = $_POST['password'];
//            $date_de_naissance = $_POST['date_de_naissance'];
//            $type = $_POST['type'];
//            $description = $_POST['description'];
//            $ville = $_POST['ville'];
//            $interests = $_POST['interests'];
//            $photo = $_POST['photo'];
//            $isvalide = 1;
//            $idpromos = $_POST['idpromos'];
//
//            // Valider le mot de passe
//            if (!validatePassword($password)) {
//                echo "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, un chiffre et un caractère spécial.";
//                exit;
//            }
//
//            // Valider l'email
//            if (!validateEmail($mail, $type)) {
//                echo "L'adresse e-mail n'est pas valide.";
//                exit;
//            }
//
//            // Créer un nouvel utilisateur
//            $user = new Database;
//            $result = $user->createUser($nom, $prenom, $mail, $password, $date_de_naissance, $type, $description, $ville, $interests, $photo, $isvalide, $idpromos);
//
//            if ($result) {
//                echo "Utilisateur créé avec succès.";
//            } else {
//                echo "Erreur lors de la création de l'utilisateur.";
//            }
//        }
//    }
}