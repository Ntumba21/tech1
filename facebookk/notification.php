
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

                    <div class="createPost">

                        <h3 class="mini-headign">Identification</h3>  


                    </div>

                   
                    <div class="fb-post1-header">
                            </div>
                    <?php $post = $db->getLastPostUserForNotif($_SESSION['userident']); ?>
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



</body>
</html>