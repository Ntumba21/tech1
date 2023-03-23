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
            <img src="../media/left-chevron.svg">
            <p>Back</p>
        </div>

        <div class="utilisateur">
            <p>John Doe</p>
            <p>Active Now</p>
        </div>
    </div>
    <div class="conversation">
    <?php 
    require_once '../controller/message.php';
    require_once '../controller/session.php';
    $mail= $_SESSION['mail'];
    $database = new Database();
    $message = $database->getUserByEmaill($mail);
    ?>
        <?php foreach ($messages as $message): ?>
            <div class="talk <?php echo $message['sender_id'] == $iduser ? 'right' : 'left'; ?>">
                <img src="ressources/avatar<?php echo $message['sender_id'] == $iduser ? '1' : '2'; ?>.jpg">
                <p><?php echo htmlspecialchars($message['contenu']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <form class="chat-form" action="message_handler.php" method="POST">
        <input type="hidden" name="idamis" value="<?php echo $idamis; ?>">

        <div class="container-inputs-stuffs">
            <div class="group-inp">
                <textarea name="message" placeholder="Enter your message here" minlength="1" maxlength="1500"></textarea>
                <img src="../media/smile.svg">
            </div>

            <button type="submit" class="submit-msg-btn">
                <img src="../media/send.svg">
            </button>
        </div>
    </form>
</div>

</body>
</html>
