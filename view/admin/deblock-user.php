<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/showuser.php");
//if(!VerifySession()){header('Location: index.html');}?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../view/style/manage.css">
</html>
<body>
<article>
    <br><br>
    <h1>Debloquer un utilisateur</h1>
    <form action="../../controller/admin/deblockuser.php" method="post" name="debloquer">
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
            <input type="submit" name="submit" value="Debloquer">
    </form>
</article>
</body>
</html>