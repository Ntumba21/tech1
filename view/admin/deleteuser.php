<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/showuser.php")?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
    </head>
    <body>
    <header>
        <div>logo</div>
    </header>
    <section>
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
                    </tr>
                <?php ShowUser(); ?>
                <input type="submit" name="submit" value="Supprimer">
            </form>
        </article>
    </section>
    <footer>
        <div>footer</div>
    </footer>
    </body>
</html>
