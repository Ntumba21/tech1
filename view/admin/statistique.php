<?php
require_once("../../controller/session.php");
require_once ("../../modele/Database.php");
require_once ("../../controller/admin/statuser.php");
$data = new Database();
$showuser = $data->ShowMaxUser();
//if(!VerifySession()){header('Location: index.html');}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Statistique</title>
        <link rel="stylesheet" href="../../view/style/sup.css">
    </head>
    <body>
        <header>
            <img src="../../media/logo ECEBOOK.png" alt="Logo" class="logo">
            <h1>Statistique</h1>
        </header>
        <main class="content">
                <section>
                    <p>Le Nombre d'utilisateurs dans le système est:</p> <?php $showuser(); ?>
                </section>
                <section>
                    <h2>Les utilisateurs ayant créé le plus de message dans le systeme:</h2>
                    <table>
                        <tr>
                            <th>Mail</th>
                            <th>Nombre de message</th>
                        </tr>
                        <?php MakeStatForMessage(); ?>
                    </table>
                </section>
        </main>
        <footer>
            <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
        </footer>
    </body>
</html>