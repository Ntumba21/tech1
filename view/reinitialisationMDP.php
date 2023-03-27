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
        <h2>Réinitialisation du mot de passe</h2>
        <form action="../controller/reinitialisationMDP.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="mail">E-mail :</label>
                <input type="email" name="mail" id="mail" required>
            </div>
            <button type="submit">Demander la réinitialisation</button>
        </form>
    </div>
</div>
</body>
</html>
