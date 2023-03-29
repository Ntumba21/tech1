<?php
require_once '../modele/Database.php';

require_once '../controller/src/PHPMailer.php';
require_once '../controller/src/SMTP.php';
require_once '../controller/src/Exception.php';
require_once 'session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function uniqueEmail($email) {
    $db = new Database();
    $result = $db->GetUserByEmail($email);
    if ($result) {
        return false;
    } else {
        return true;
    }
}
function sendActivationEmail($email, $token) {
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
        $mail->addAddress($email);

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Activation de votre compte EceBook';
        $mail->Body = 'Cliquez sur ce lien pour activer votre compte: <a href="http://localhost/projet-tech/controller/activationMailRegister.php?email=' . urlencode($email) . '&token=' . urlencode($token) . '">Activer mon compte</a>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function validatePassword($password) {
    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    return preg_match($pattern, $password);
}

function validateEmail($email, $type) {
    if ($type == 1) {
        $pattern = '/^[a-zA-Z0-9._%+-]+@edu\.ece\.fr$/';
    } elseif ($type == 2) {
        $pattern = '/^[a-zA-Z0-9._%+-]+@(ece\.fr|omnesintervenant\.com)$/';
    } else {
        return false;
    }
    return preg_match($pattern, $email);
}

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
    $isvalide = 0;
    $idpromos = $_POST['idpromos'];
    $token = bin2hex(random_bytes(32));
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


    // Valider le mot de passe
    if (!validatePassword($password)) {
        $_SESSION['alert-register']= "<div class='alert alert-danger' role='alert'>Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.</div>";
        if($type == 1){
            $_SESSION['redirection'] = '../view/register.php';
        }elseif($type == 2){
            $_SESSION['redirection'] = '../view/register-prof.php';
        }
        header("Location: {$_SESSION['redirection']}");
        exit;
    }

    // Valider l'email
    if (!validateEmail($mail, $type)) {
        $_SESSION['alert-register']= "<div class='alert alert-danger' role='alert'>L'adresse e-mail n'est pas valide.</div>";
        if($type == 1){
            $_SESSION['redirection'] = '../view/register.php';
        }elseif($type == 2){
            $_SESSION['redirection'] = '../view/register-prof.php';
        }
        header("Location: {$_SESSION['redirection']}");
        exit;
    }

    // Vérifier si l'email est déjà utilisé
    if(!uniqueEmail($mail)){
        if($type == 1){
            $_SESSION['redirection'] = '../view/register.php';
        }elseif($type == 2){
            $_SESSION['redirection'] = '../view/register-prof.php';
        }
        $_SESSION['alert-register'] = "<div class='alert alert-danger' role='alert'>L'adresse e-mail est déjà utilisée.</div>";
        header("Location: {$_SESSION['redirection']}");
        exit;
    }

     //Créer un nouvel utilisateur
    $data = new Database();
    $result = $data->createUser($nom, $prenom, $mail, $password, $date_de_naissance, $type, $description, $ville, $interests, $photo, $isvalide, $token);

    if ($result) {
        if ($type == 1) {
            $data->registerPromo($mail,$idpromos);
            $data->defaultFriend($mail);
            $_SESSION['alert-register']="<div class='alert alert-success' role='alert'>Utilisateur créé avec succès. Veuillez vérifier votre e-mail pour activer votre compte.</div>";
            header('Location: ../view/register.php');
        }elseif ($type == 2){
            foreach ($idpromos as $idpromo){
                $data->registerPromo($mail,$idpromo[0]);
            }
            $_SESSION['alert-register']="<div class='alert alert-success' role='alert'>Utilisateur créé avec succès. Veuillez vérifier votre e-mail pour activer votre compte.</div>";
            header('Location: ../view/register-prof.php');
        }
        if (sendActivationEmail($mail, $token)) {
            $_SESSION['alert-register']= "Utilisateur créé avec succès. Veuillez vérifier votre e-mail pour activer votre compte.";
            //$data->defaultFriend($mail,$idpromos);
        } else {
            $_SESSION['alert-register']= "Erreur lors de l'envoi de l'e-mail d'activation. Veuillez contacter l'administrateur.";
        }
} else {
        $_SESSION['alert'] = "<div class='alert alert-danger' role='alert'>Erreur lors de la création de l'utilisateur.</div>";
        header('Location: ../view/alert.php');
}
}

