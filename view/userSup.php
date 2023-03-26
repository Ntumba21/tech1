<?php require_once("../controller/session.php");
// decommenter pour activer la verification de session
//if(!VerifySession()){header('Location: ../index.php');} ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <link rel="stylesheet" href="../view/style/sup.css">
</head>
<body>
<header>
    <img src="../media/logo ECEBOOK.png" alt="Logo" class="logo"> 
    <h1>Delete Account</h1>
</header>
<div class="content">
    <div class="square">
</head>
    <form method="POST" action="../controller/userSup.php">
      <label for="mail">Email:</label>
      <input type="email" name="mail" id="mail" required>
      <br>
      <button type="submit">Delete Account</button>
    </form>
    </div>
</div>
</body>
<footer>
<a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
</footer>

</html>

