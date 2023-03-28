<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/showuser.php");
//if(!VerifySession()){header('Location: index.html');}?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../facebookk/style.css">
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
                    <img src="images/us2.png" alt="user">
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
           

  

                 <body>
   

                    <div class="square">
                        <article>
                            <h1>Bloquer un utilisateur</h1>
                        </article>

                        <form action="../../controller/admin/blockuser.php" method="post" name="bloqer">
                            <table>
                                <tr>
                                    <th>delete</th>
                                    <th>nom</th>
                                    <th>prenom</th>
                                    <th>mail</th>
                                    <th>description</th>
                                    <th>ville</th>
                                    <th>interests</th>
                                    <th>photo</th>
                                    <th>promos</th>
                                    <th>isvalide</th>
                                </tr>
                                <?php ShowActiveUser(); ?>
                            </table>

                            <input type="submit" name="submit" value="bloquer">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <footer>
        <a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofia</a>
    </footer>
</body>






   