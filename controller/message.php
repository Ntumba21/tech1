<?php
require_once '../modele/Database.php';
require_once '../controller/session.php';


$data = new Database();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'send') {
        send();
    } elseif ($action == 'getMessages') {
        displayMessages();
    }
}

function send() {
    if (isset($_POST['content']) && !empty($_POST['content'])) {
        $content = $_POST['content'];
        $sender_id = $_SESSION['user_id'];
        $receiver_id = $_GET['receiver_id'];
        $data = new Database();
        $data->sendMessage($sender_id, $receiver_id, $content);
    }
}

function getMessages() {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_GET['receiver_id'];
    $data = new Database();
    return $data->getMessagesBetweenUsers($sender_id, $receiver_id);
}

function displayMessages() {
    header('Content-Type: text/html; charset=utf-8');
    $messages = getMessages();
    foreach ($messages as $message) {
        echo $message['iduser'] == $_SESSION['user_id'] ? '<div class="talk right">' : '<div class="talk left">';
        if ($message['iduser'] != $_SESSION['user_id']) {
            echo '<img src="../media/smile.svg">';
        }
        echo '<p>' . htmlspecialchars($message['content']) . '</p>';
        echo '</div>';
    }
}
