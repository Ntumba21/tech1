<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="../view/style/post.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>



    <div class="home">
    <div class="container">
        <div class="home-weapper">

           <!--GAUCHE-->
            <div class="home-left">
                 <!-- BON-->
  
                 <div class="createPost">
    <h3 class="mini-headign">Connexion</h3>
    

<div class="textbox">
<h1>Connexion</h1>
<h2>ECEBOOK helps you to connect, 
    
<form action="../controller/login.php" method="post">
<div class="form">
    <label for="email">Adresse e-mail :</label>
    <input type="email" name="email" required><br>
    <div class="form">
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>
    <div class="form">
    <button type="submit">Se connecter</button>
    </form>
    <p><a href="../view/reinitialisationMDP.php">forgot password?</a><br></p>
    <div class="btn">
                   
    <button>create New Account<a href="../view/register.php"></button>
                 </div>

    </div>
</div>

</body>

</html>
