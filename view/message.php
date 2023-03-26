<?php
require_once '../controller/session.php';
require_once '../modele/Database.php';
// decommenter pour activer la verification de session
//if(!VerifySession()){header('Location: ../index.php');}

$id_amis = $_GET['id'];
$id_user = $_SESSION['iduser'];

$db = new Database();
$ami = $db->getUserById($id_amis);
$messages = $db->getMessages($id_user, $id_amis);
$currentUser = $db->getUserById($_SESSION['iduser']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../view/style/message.css">
</head>
<body>
   
<div class="chat-global">
    <div class="nav-top">
        <div class="location">
        <a href="../facebookk/index.php" style="display: flex; align-items: center; text-decoration: none; color: inherit;">
        <img src="../media/left-chevron.svg">
        <p>Back</p>
    </a>
        </div>

        <div class="utilisateur">
            <p><?php echo $ami['nom'] . ' ' . $ami['prenom']; ?></p>
            <p>Active Now</p>
        </div>
    </div>

    <div class="conversation">
    <?php foreach ($messages as $message): ?>
        <div class="talk <?php echo $message['iduser'] == $id_user ? 'right' : 'left'; ?>">
            <img src="<?php echo $message['iduser'] == $id_user ? $currentUser['photo'] : $ami['photo']; ?>">
            <p><?php echo htmlspecialchars($message['contenu']); ?></p>
        </div>
    <?php endforeach; ?>
</div>


    <form class="chat-form" action="../controller/sendMessage.php" method="POST">
        <input type="hidden" name="id_amis" value="<?php echo $id_amis; ?>">

        <div class="container-inputs-stuffs">
            <div class="group-inp">
                <textarea name="message" placeholder="Enter your message here" minlength="1" maxlength="1500"></textarea>
            </div>

            <button type="submit" class="submit-msg-btn">
                <img src="../media/send.svg">
            </button>
        </div>
    </form>
</div>

</body>
</html>
