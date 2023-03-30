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
        <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
        <div class="header-container">
            <div class="header-wrapper">
                <div class="logoBox">
                    <img src="../../media/logo ECEBOOK.png" alt="logo">
                </div>
                <section>
                    <h1 class="mini-headign">Statistique</h1>
                </section>
                <div class="iconBox2">
                <i class="fa-solid fa-house"></i>
                </div>
            </div>
        </div>
    </header>


    <main class="home">
        <section>
            <article class="firt-article">
                <p>Le Nombre d'utilisateurs dans le système est : </p> <p><?php echo $showuser; ?></p>
            </article>
        </section>
        <section class="home-weapper">

           <!--GAUCHE-->
            <article class="home-left">
                 <!-- BON-->
                <div class="data-contain">
                    <p>Les utilisateurs ayant créé le plus de message dans le systeme:</p>
                    <table>
                        <tr>
                            <th>Mail</th>
                            <th>Nombre de message</th>
                        </tr>
                        <?php MakeStatForMessage(); ?>
                    </table>
                </div>
                <div class="data-contain">
                    <p>Les utilisateurs ayant le plus d'amis:</p>
                    <table>
                        <tr>
                            <th>Mail</th>
                            <th>Nombre de message</th>
                        </tr>
                        <?php MakeStatForFriendship(); ?>
                    </table>
                </div>
                <div class="data-contain">
                    <p>les 5 posts ayant le plus de like:</p>
                    <table>
                        <tr>
                            <th>Titre du post</th>
                            <th>Nombre de likes</th>
                        </tr>
                        <?php MakeStatForlikePerPost(); ?>
                    </table>
                </div>
            </article>
            <article class="graphique">
                <p>Message sur les 30 derniers jours</p>
                <div>
                    <canvas id="myChart" width="70vh" height="35vh"></canvas>
                </div>
                <?php MakeStaForMessagePerDay(); ?>
            </article>
        </section>
    </main>
<!--        <footer>-->
<!--            <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>-->
<!--        </footer>-->
</body>
</html>