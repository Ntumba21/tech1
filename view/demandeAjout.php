<?php
session_start();
require_once 'Database.php';
require_once 'FriendController.php';

$db = new Database();
$friendController = new FriendController($db);

// Get friend requests for the current user
$friendRequests = $friendController->getFriendRequests($_SESSION['user_email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend Requests</title>
</head>
<body>
    <h1>Friend Requests</h1>

    <?php if (!empty($friendRequests)): ?>
        <ul>
            <?php foreach ($friendRequests as $request): ?>
                <li>
                    <?= htmlspecialchars($request['requester_email']) ?> wants to be your friend.
                    <form action="" method="post">
                        <input type="hidden" name="requester_id" value="<?= $request['requester_id'] ?>">
                        <input type="submit" name="accept" value="Accept">
                        <input type="submit" name="reject" value="Reject">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No friend requests.</p>
    <?php endif; ?>
</body>
</html>
