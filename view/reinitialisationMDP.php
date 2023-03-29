<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="../view/style/loginForm.css">
   
<body>
<header>
<div class="textbox">
<h1>Réinitialisation
    </h1>
<h2>ECEBOOK helps you to connect,
    create, delete, modify a post and send message
</h2> 
</div>
<div class="container" style="background-color: transparent">
<div class="form">
       
        <form action="../controller/reinitialisationMDP.php" method="post" enctype="multipart/form-data">
            
                <label for="mail">E-mail :</label>
                <input type="email" name="mail" id="mail" required>
           
            <button type="submit">Demander la réinitialisation</button>
        </form>
    </div>
</div>
</body>


</html>
