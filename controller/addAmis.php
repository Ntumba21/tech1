<?php
session_start();

require_once '../modele/Database.php';
require_once '../controller/session.php';

if (!isset($_SESSION['mail'])) {
    header("Location: home.php");
    exit;
}

$user_email = $_SESSION['mail'];
$friend_email = $_POST['friend_email'];

$db = new Database();
$result = $db->addFriend($user_email, $friend_email);

if ($result) {
    echo'ajouté';
} else {
    echo 'erreur';
}
?>