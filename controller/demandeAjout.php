<?php

require_once 'Database.php';
require_once 'FriendController.php';

$db = new Database();

// Get friend requests for the current user
$db->getFriendRequests($_SESSION['user_email']);

// Accept a friend request
if (isset($_POST['accept'])) {
    $db->acceptFriendRequest($_POST['requester_id'], $_SESSION['user_id']);
}

// Reject a friend request
if (isset($_POST['reject'])) {
    $db->rejectFriendRequest($_POST['requester_id'], $_SESSION['user_id']);
}

?>