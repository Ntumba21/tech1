<?php require_once("../controller/session.php");
// decommenter pour activer la verification de session
//if(!VerifySession()){header('Location: ../index.php');} ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <link rel="stylesheet" href="../view/style/loginForm.css">
    
</head>
<body>


<div class="textbox">
<h1>Delete Account</h1>
<h2>ECEBOOK helps you to connect,
    create, delete, modify a post and send message
</h2> 
</div>
<div class="container" style="background-color: transparent">
<div class="form">
   
    <form method="POST" action="../controller/userSup.php">
      <label for="mail">Email:</label>
      <input type="email" name="mail" id="mail" required>
      <br>
      
      <button type="submit">Delete Account</button>
      </form>
    </div>
</div>

</body>


</html>

