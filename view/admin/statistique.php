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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="../../view/style/sup.css">
    </head>
    <body>
        <header>
            <img src="../../media/logo ECEBOOK.png" alt="Logo" class="logo">
            <h1>Statistique</h1>
        </header>
        <main class="content">
                <section>
                    <p>Le Nombre d'utilisateurs dans le système est:</p> <?php echo $showuser; ?>
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
            <section>
                <h2>Les utilisateurs ayant créé le plus d'amis:</h2>
                <table>
                    <tr>
                        <th>Mail</th>
                        <th>Nombre de message</th>
                    </tr>
                    <?php MakeStatForFriendship(); ?>
                </table>
            </section>
            <section>
                <h2>les 5 posts ayant le plus de like:</h2>
                <table>
                    <tr>
                        <th>Titre du post</th>
                        <th>Nombre de likes</th>
                    </tr>
                    <?php MakeStatForlikePerPost(); ?>
                </table>
            </section>
            <section>
                <h2>Message sur les 30 derniers jours</h2>
                <table>
                    <tr>
                        <th>Mail</th>
                        <th>Nombre de message</th>
                    </tr>
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                    <?php MakeStaForMessagePerDay(); ?>
                </table>
            </section>
        </main>
        <footer>
            <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
        </footer>
    </body>
</html>