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
<br><br>
<article>
    <h1>Supprimer un utilisateur</h1>
    <form action="../../controller/admin/deleteuser.php" method="post" name="Supprimer">
        <table>
            <?php ShowUser(); ?>
        </table>
        <input type="submit" name="submit" value="Supprimer">
    </form>
</article>
</body>
</html>