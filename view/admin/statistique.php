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
        <link rel="stylesheet" href="../../view/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
        <div class="header-container">
            <div class="header-wrapper">
                <div class="logoBox">
                    <img src="../../media/logo ECEBOOK.png" alt="logo">
                </div>
                <div class="searchBox">
                    <input type="search">
                    <i class="fas fa-search"></i>
                </div>
                <div class="iconBox2">
                <i class="fa-solid fa-house"></i>
                    <i class="fa-solid fa-bell"></i>
                    <label>  <a href="../../facebookk/profil.php">
                    <img src="../../facebookk/images/us2.png" alt="user">
                     </label></a>
                </div>
            </div>
        </div>
    </header>


    <div class="home">
    <div class="container">
        <div class="home-weapper">

           <!--GAUCHE-->
            <div class="home-left">
                 <!-- BON-->
                 <h1 class="mini-headign">Statistique</h1>
    

           
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
       <!-- <footer>
            <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
        </footer> -->
    </body>
</html>