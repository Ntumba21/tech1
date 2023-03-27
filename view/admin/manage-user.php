<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/showuser.php");
//if(!VerifySession()){header('Location: index.html');}?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <link rel="stylesheet" href="../../view/style/manage.css">

    </head>
    <body>
    <div class="wrapper">
    <header>    
       
        <img src="../../media/logo ECEBOOK.png" alt="Logo" class="logo"> 
    <h1>pannel Admin</h1>
</header>
<div class="content">
    <div class="square">
    
    <section>
        <article>
            <h1>Bloquer un utilisateur</h1>
            <form action="../../controller/admin/deblockuser.php" method="post">
                <table>
                    <tr>
                        <th>delete</th>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>mail</th>
                        <th>date_de_naissance</th>
                        <th>description</th>
                        <th>ville</th>
                        <th>interests</th>
                        <th>photo</th>
                        <th>promos</th>
                        <th>isvalide</th>
                    </tr>
                    <?php ShowBlockUser(); ?>
                    <input type="submit" name="submit" value="bloquer">
            </form>
        </article>
        <article>
<br><br>
            <h1>Debloquer un utilisateur</h1>
            <form action="../../controller/admin/blockuser.php" method="post">
                <table>
                    <tr>
                        <th>delete</th>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>mail</th>
                        <th>date_de_naissance</th>
                        <th>description</th>
                        <th>ville</th>
                        <th>interests</th>
                        <th>photo</th>
                        <th>promos</th>
                        <th>isvalide</th>
                    </tr>
                    <?php ShowUser(); ?>
                    <input type="submit" name="submit" value="Debloquer">
            </form>
        </article>
     <br><br>
        <article>
            <h1>Supprimer un utilisateur</h1>
            <form action="../../controller/admin/deleteuser.php" method="post">
                <table>
                    <tr>
                        <th>delete</th>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>mail</th>
                        <th>date_de_naissance</th>
                        <th>description</th>
                        <th>ville</th>
                        <th>interests</th>
                        <th>photo</th>
                        <th>promos</th>
                        <th>isvalide</th>
                    </tr>
                <?php ShowUser(); ?>
                <input type="submit" name="submit" value="Supprimer">
            </form>
        </article>
    </section>
    </div>
</div>

    </div>
</div>

</body>


</html>

