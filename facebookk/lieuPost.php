<?php 
require_once '../modele/Database.php';
require_once '../controller/session.php';
$user_email = $_SESSION['mail'];
$db = new Database();


if (isset($_GET['id'])) {
    $lieu_id = $_GET['id'];
} else {
    // Si l'ID n'est pas défini dans l'URL, rediriger vers une page d'erreur ou la page d'accueil
    header('Location: index.php');
    exit();
}
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
<script>
        function refreshPage() {
            window.location.reload();
        }
    </script>

    
<!-- header section start -->


<header>
    <div class="header-container">
        <div class="header-wrapper">
        <?php $user = $db->getUserByEmail($_SESSION['mail']);?>
            <div class="logoBox">
                <img src="../media/logo ECEBOOK.png" alt="logo">
            </div>
            <div class="searchBox">
               
            </div>
            <div class="iconBox2">
                <!-- Lien vers index.php avec l'icône de la maison -->
                <a href="../facebookk/index.php">
                    <i class="fa-solid fa-house"></i>
                </a>
                
                <a href="../facebookk/profil.php">
                    <img src="<?php echo $user['photo'] ?>"  alt="user" height="50">
                </a>
                <!-- Bouton de déconnexion -->
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> 
                </a>
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
<?php $lieu = $db->getNomByLieu($lieu_id);?>
        <div class="friend">
        <h3 class="heading">Lieu</h3>
        <div style="margin-top:5px">
      </div>

      <h4><?php echo $lieu["nom"]; ?></h4>
        </div>
    </div>



 
            </div><!-- home left end here -->

            <!-- home center start here -->

            <div class="home-center">
                <div class="home-center-wrapper">
                        
</div>

                   
                    <div class="fb-post1-header">
                                <ul>
                                    <li>see all</li>
                                
                                </ul>
                            </div>
                    <?php $post = $db->ShowPostByLieu($lieu_id); ?>
                    <?php foreach ($post as $p) {?>
                    <div class="fb-post1">
                        <div class="fb-post1-container">
                            <div class="fb-p1-main">
                                <?php
    echo '<div class="post">';
    echo '<div class="post-header">';
    echo '<h2>' . $p['prenom'] . '</h2>';
    echo '<h2>' . $p['titre'] . '</h2>';
    echo '<span>' . $p['date'] . '</span><br>';
    echo '<a href="../facebookk/profileUnique.php?id=' . $p['etiquette'] . '">' . '@'.$p['etiquette_prenom'] . '</a><br>';
    echo '<a href="../facebookk/lieuPost.php?id=' . $p['idlieu'] . '">' . '@'.$p['lieu_nom'] . '</a>';
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
    echo '<img src="images/love.png" alt="love" class="like-button" idpost="'.$p['idpost'].'" onclick="refreshPage()">';
    echo '</li>';
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