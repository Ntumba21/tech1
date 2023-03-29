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
<div class="textbox">
<h1>Delete user</h1>

</div>
<div class="container">
<div class="form">
    <form action="../../controller/admin/deleteuser.php" method="post" name="Supprimer">
        <table>
            <?php ShowUser(); ?>
        </table>
        <input type="submit" name="submit" value="Supprimer">
    </form>
</article>
</body>
</html>