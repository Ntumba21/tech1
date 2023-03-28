<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/postfunction.php");
//if(!VerifySession()){header('Location: index.html');}?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../view/style/manage.css">
</head>
<body>
<main>
    <!--lien pour modifier un post-->
    <!--lien pour ajouter un post-->
    <section>
        <h1>Vous voulez modifier quel post?</h1>
        <form name="post" method="post" action="../../controller/admin/show-alter-post.php">
            <label for="idpost">idpost</label>
            <select name="idpost" id="idpost">
                <?php ShowPostinlist(); ?>
            </select>
            <input type="submit" name="submit" value="Modifier">
        </form>
    </section>
</main>


