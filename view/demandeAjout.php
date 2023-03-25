<?php
require_once '../modele/Database.php';
require_once '../controller/session.php';

$db = new Database();
$friendRequests = $db->getFriendRequests($_SESSION['iduser']);
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
                    <?= htmlspecialchars($request['iduser']) ?> Veut etre ton ami
                    <form action="../controller/demandeAjout.php" method="post">
                        <input type="hidden" name="requester_id" value="<?= $request['iduser']?>">
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
