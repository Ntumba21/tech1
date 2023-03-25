<?php

require_once '../modele/Database.php';
require_once '../controller/session.php';

$db = new Database();

// Get friend requests for the current user
$db->getFriendRequests($_SESSION['iduser']);

// Accept a friend request
if (isset($_POST['accept'])) {
    $db->acceptFriendRequest($_SESSION['iduser'],$_POST['requester_id'] );
}

// Reject a friend request
if (isset($_POST['reject'])) {
    $db->rejectFriendRequest($_SESSION['iduser'],$_POST['requester_id'] );
}

?>