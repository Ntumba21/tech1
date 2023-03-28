
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
    <link rel="stylesheet" href="style2.css">
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    
<!-- header section start -->


    <header>
        <div class="header-container">
            <div class="header-wrapper">
            <?php $user = $db->getUserByEmail($_SESSION['mail']);?>
                <div class="logoBox">
                    <img src="../media/logo ECEBOOK.png" alt="logo">
                </div>
                <div class="searchBox">
                    <input type="search">
                    <i class="fas fa-search"></i>
                </div>
                <div class="iconBox2">
                
                <label>  <a href="../facebookk/index.php">
                <i class="fa-solid fa-house"></i>
                     </label></a>
                    <i class="fa-solid fa-bell"></i>
                    <label><img src="<?php echo $user['photo'] ?>" alt="user"></label>
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
<?php $user = $db->getUserByEmail($_SESSION['mail']);?>
        <div class="friend">
        <h3 class="heading">Profil</h3>
        <div style="margin-top:5px">
        <img class="rounded-circle" src="<?php echo $user['photo'] ?>" width="100" alt="user">
      </div>

      <h4><?php echo $user["nom"]; ?></h4>
      <h4><?php echo $user["prenom"]; ?></h4>
      <h4><?php echo $user["date_de_naissance"]; ?></h4>
      <h4><?php echo $user["description"]; ?></h4>
      <h4><?php echo $user["ville"]; ?></h4>
      <h4><?php echo $user["interests"]; ?></h4>
    
        </div>
    </div>

    <div class="event-friend">
        <div class="friend">
            <h3 class="heading">Edit profil</h3>
            <form action="../controller/editprofil.php" method="POST" enctype="multipart/form-data">
            <?php $db->getUserByEmail($_SESSION['mail']);?>

<textarea id="description" name="description" placeholder="description"></textarea><br>

<input type="text" id="ville" name="ville" placeholder="ville"><br>

<input type="text" id="interests" name="interests" placeholder="interests"><br>

<input type="file" name="photo" placeholder="photo"><br><br>

  <input type="submit" name="submit" value="Edit">
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
                        

                        <div class="post-icon">
                           

                        </div>

                    </div>

                   
                    <div class="fb-post1-header">
                               
                            </div>
                    <?php $post = $db->showPostUser($_SESSION['iduser']); ?>
                    <?php foreach ($post as $p) {?>
                    <div class="fb-post1">
                        <div class="fb-post1-container">
                            <div class="fb-p1-main">
                                <?php
    echo '<div class="post">';
    echo '<div class="post-header">';
    echo '<h2>' . $p['prenom'] .'</h2>';
    echo '<h2>' . $p['titre'] . '</h2>';
    echo '<span>' . $p['date'] . '</span><br>';
    echo '<a href="../facebookk/profileUnique.php?id=' . $p['etiquette'] . '">' . '@'.$p['etiquette_nom'] . ' ' . $p['etiquette_prenom'] . '</a><br>';
    echo '<a href="../facebookk/lieuPost.php?id=' . $p['idlieu'] . '">' . '@'. $p['lieu_nom'] . '</a>';
    echo '</div>';
    echo '<div class="post-body">';
    echo '<p>' . $p['contenu'] . '</p>';
    if ($p['photo']) {
        echo '<img src="' . $p['photo'] . '" alt="photo">';
    }
    echo '</div>';
    echo '<div class="post-footer">';
    echo '<div class="like-comment">';
    echo '<ul>';
    echo '<li>';


    
    echo '<span class="post-likes">' . $p['nb_likes'] . ' likes</span>';
    echo '<img src="images/love.png" alt="love" class="like-button" idpost="'.$p['idpost'].'">';
    echo '</li>';
    echo '<li>';
    echo '<div class="post-actions">';
echo '<a href="../view/editpost.php?id=' . $p['idpost'] . '">Edit your post</a>';
echo '</div>';

    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
}?>
                
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).on('click', '.like-button', function () {
    var button = $(this);
    var idpost = button.attr("idpost");
    $.ajax({
        url: "../controller/like.php",
        type: "POST",
        data: {
            idpost: idpost
        },
        success: function () {
            // Increment like count
            var count = parseInt($(".like-count-" + idpost).text()) + 1;
            $(".like-count-" + idpost).text(count);

            // Disable like button
            button.prop('disabled', true);
        }
    });
});
</script>


</body>
</html>