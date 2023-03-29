<?php require_once '../../controller/session.php';
//pour verifier si la session est valide
//if(!VerifySession()){header('Location: index.html');}
require_once '../../controller/admin/postfunction.php'?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../../view/admin/style/user.css">
</head>  
<h1>Delete post</h1>
    <div class="textbox">


</div>
<div class="container">
<div class="form">
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
                        <th>destinataire</th>
                    </tr>
                    <?php ShowAllPost(); ?>
                </table>
                <input type="submit" name="submit" value="supprimer">
        </section>
    </div>
    </div>
       <!-- <footer>
    <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
    </footer> -->
    </body>
</html>
