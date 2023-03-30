<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/showuser.php");
//if(!VerifySession()){header('Location: index.html');}?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../view/admin/style/user.css">
</head>
<body>
<div class="textbox">
<h1>Delete user</h1>

</div>
<div class="container">
<div class="form">
    <form action="../../controller/admin/deleteuser.php" method="post" name="Supprimer">
        <table>
            <tr>
                <th>delete</th>
                <th>nom</th>
                <th>prenom</th>
                <th>mail</th>
                <th>Année de naissance</th>
                <th>Description</th>
                <th>ville</th>
                <th>interests</th>
                <th>photo</th>
                <th>promos</th>
                <th>isvalide</th>
            </tr>
            <?php ShowUser(); ?>
        </table>
        <input type="submit" name="submit" value="Supprimer">
    </form>
</div>
    </div>
</body>
</html>