<?php
require_once '../controller/session.php';
require_once '../modele/Database.php';

$id_user = $_SESSION['iduser'];
$id_amis = $_POST['id_amis'];
$message = $_POST['message'];

$db = new Database();
$db->sendMessage($id_user, $id_amis, $message);

header('Location: ../view/message.php?id=' . $id_amis);
exit();
?>
