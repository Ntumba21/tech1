<?php 
require_once '../modele/Database.php';
require_once '../controller/session.php';
$user_email = $_SESSION['mail'];
$db = new Database();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>facebook.com</title>
    <!-- style css link -->
    <link rel="stylesheet" href="style.css">
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    
<!-- header section start -->


    <header>
        <div class="header-container">
            <div class="header-wrapper">
                <div class="logoBox">
                    <img src="../media/logo ECEBOOK.png" alt="logo">
                </div>
                <div class="searchBox">
                    <input type="search">
                    <i class="fas fa-search"></i>
                </div>
                <div class="iconBox1">
                    <i class="fa-solid fa-house"></i>
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div class="iconBox2">
                    <i class="fa-brands fa-facebook-messenger"></i>
                    <i class="fa-solid fa-bell"></i>
                    <label><img src="images/us2.png" alt="user"></label>
                    <i class="fa-solid fa-caret-down"></i>
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
      
<!--FIN BON -->

<div class="event-friend">
<?php $user = $db->getUserByEmaill($_SESSION['mail']);?>
        <div class="friend">
        <div style="margin-top:100px">
        <img class="rounded-circle" src="<?php echo $user['photo'] ?>" width="100" alt="user">
      </div>

    <form action="../controller/editprofil.php" method="POST" enctype="multipart/form-data">
      <label for="nom">Nom*: </label>
      <input type="text" id="nom" name="nom" value="<?php echo $user["nom"]; ?>"><br>

      <label for="prenom">Prénom*: </label>
      <input type="text" id="prenom" name="prenom" value="<?php echo $user["prenom"]; ?>"><br>

      <label for="date_de_naissance">Date de naissance*: </label>
      <input type="date" id="date_de_naissance" name="date_de_naissance" value="<?php echo $user["date_de_naissance"]; ?>"><br>

      <label for="description">Description: </label>
      <textarea id="description" name="description"><?php echo $user["description"]; ?></textarea><br>

      <label for="ville">Ville: </label>
      <input type="text" id="ville" name="ville" value="<?php echo $user["ville"]; ?>"><br>

      <label for="interests">Centres d'intérêt: </label>
      <input type="text" id="interests" name="interests" value="<?php echo $user["interests"]; ?>"><br>

      <label for="photo">Photo:</label>
      <input type="file" name="photo"><br><br>
      
        <input type="submit" name="submit" value="Enregistrer les modifications">
    </form>
        </div>
    </div>
                 
                
            </div><!-- home left end here -->

            <!-- home center start here -->

            <div class="home-center">
                <div class="home-center-wrapper">
                        
                    </div>


                    <div class="createPost">

                        <h3 class="mini-headign">Modify Post</h3>
                        <div class="post-text">
                            <img src="images/us2.png" alt="user">
                            <input type="text-area" placeholder="Bonjour, quesque vous voulez poster aujourd'hui ?">
                        </div>

                        <div class="post-icon">
                            <a href="#" style="background: #ffebed;">
                            <i style="background: #ff4154;" class="fa-solid fa-camera"></i>
                            Gallery</a>

                            <a href="#" style="background: #d7ffef;">
                            <i style="background: #00d181;" class="fa-solid fa-location-dot"></i>
                            Location</a>

                        </div>

                    </div>

                   
                    <div class="fb-post1">
                        <div class="fb-post1-container">
                            <div class="fb-post1-header">
                                <ul>
                                    <li>see all</li>
                                    <li>recent</li>
                                </ul>
                            </div>
                            <div class="fb-p1-main">
                                <div class="post-title">
                                    <img src="images/us2.png" alt="user picture">
                                    <ul>
                                        <li><h3>User<span> .2 hours ago</span></h3></li>
                                        <li><span>02 march at 12:55 PM</span></li>
                                    </ul>
                                    <p>Hello Everyone 
                                    </p>
                                </div>

                                <div class="post-images">
                                    <div class="post-images1">
                                        <img src="images/pp.jpg" alt="post images 01">
                                        <img src="images/pp2.jpg" alt="post images 02">
                                        <img src="images/pp3.jpg" alt="post images 03">
                                    </div>
                                    <div class="post-images2">
                                        <img src="images/pp4.jpg" alt="post images 04">
                                    </div>
                                </div>

                                <div class="like-comment">
                                    <ul>
                                        <li>
                                            <img src="images/love.png" alt="love">
                                            <span>22k like</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- home center wrapper end -->
            </div> <!-- home center end -->

            






        </div>
    </div>
</div>




<!-- home section end -->

<script>
    var darkButton = document.querySelector(".darkTheme");

    darkButton.onclick = function(){
        darkButton.classList.toggle("button-Active");
        document.body.classList.toggle("dark-color")
    }

</script>

</body>
</html>