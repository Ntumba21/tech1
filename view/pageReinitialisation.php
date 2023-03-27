<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
</head>
<body>
<div class="content">
    <div class="square">
        <form action="../controller/pageReinitialisation.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
            <div class="form-group">
                <label for="password">Nouveau mot de passe :</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmez le nouveau mot de passe :</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <button type="submit">Mettre à jour le mot de passe</button>
        </form>
    </div>
</div>
</body>
</html>
