<?php require_once("../../controller/session.php");
require_once ("../../controller/promo.php");
//if(!VerifySession()){header('Location: index.html');} ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="../../view/style/sup.css">
</head>
<body>
    <header>

        <img src="../../media/logo ECEBOOK.png" alt="Logo" class="logo">
        <h1>ajouter une promo</h1>
    </header>
    <div class="content">
    <div class="square">
    <main class="content">
            <section>
                
                <form method="post" action="../../controller/admin/addpromo.php">
                    <label for="addpromo">mail :</label>
                    <input type="text" id="addpromo" name="addpromo" required><br><br>

                    <input type="submit" value="ajouter">
                </form>
            </section>
    </main>
    </div>
    </div>
    <footer>
        <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
    </footer>
</body>
</html>