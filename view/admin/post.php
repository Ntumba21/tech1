<?php require_once '../../controller/session.php';
//pour verifier si la session est valide
//if(!VerifySession()){header('Location: index.html');} ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="../../view/style/sup.css">
</head>
<body>
<header>
    <img src="../../media/logo ECEBOOK.png" alt="Logo" class="logo">
    <h1>Admin</h1>
</header>
<main class="content">
    <section>
        <h1>supprimer un post</h1>
        <form name="supprimer-post" method="post" action="../../controller/admin/post.php">
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
            </table>
            <input type="submit" name="submit-delete" value="supprimer">
    </section>
    <section>
        <h1>Ajouter un Post</h1>
        <form name="ajouter-post" method="post" action="../../controller/admin/post.php">

        </form>
    </section>
</main>
</body>
<footer>
    <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
</footer>
</html>
