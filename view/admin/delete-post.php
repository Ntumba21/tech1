<?php require_once '../../controller/session.php';
//pour verifier si la session est valide
//if(!VerifySession()){header('Location: index.html');}
require_once '../../controller/admin/postfunction.php'?>
<!DOCTYPE html>
<html lang="fr">
    <section>
        <h1>supprimer un post</h1>
        <form name="supprimer-post" method="post" action="../../controller/admin/delete-post.php">
            <label for="idpost">idpost</label>
            <table>
                <tr>
                    <th>delete</th>
                    <th>Type</th>
                    <th>titre</th>
                    <th>contenu</th>
                    <th>date</th>
                    <th>photo</th>
                    <th>nblike</th>
                    <th>nbdislike</th>
                    <th>destinataire</th>
                    <th>interests</th>
                </tr>
                <?php ShowAllPost(); ?>
            </table>
            <input type="submit" name="submit" value="supprimer">
    </section>
</html>
