<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/showuser.php");
//if(!VerifySession()){header('Location: index.html');}?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../view/style/manage.css">
</html>
<body>
<article>
    <h1>Bloquer un utilisateur</h1>
    <form action="../../controller/admin/blockuser.php" method="post" name="blouqer">
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
            <?php ShowActiveUser(); ?>
            <input type="submit" name="submit" value="bloquer">
    </form>
</article>
</body>
</html>