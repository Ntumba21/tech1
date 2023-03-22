<!DOCTYPE html>
<html>
    <head>
        <title>Accueil - EceBook</title>
    </head>
    <body>
        <h1>Accueil - EceBook</h1>
        
        <?php foreach ($posts as $post) { ?>
            <div>
                <h3><?php echo $post['titre']; ?></h3>
                <p><?php echo $post['contenu']; ?></p>
                <p>Date de création : <?php echo $post['date']; ?></p>
                <p>Lieu : <?php echo $post['lieu']; ?></p>
                <?php if (!empty($post['photo'])) { ?>
                    <img src="<?php echo $post['photo']; ?>" alt="Photo du post">
                <?php } ?>
                <p>Nombre de likes : <?php echo $post['nblike']; ?></p>
                <p>Nombre de dislikes : <?php echo $post['nbdislike']; ?></p>
            </div>
        <?php } ?>
        
        <p><a href="index.php?action=myposts">Mes posts</a></p>
        <p><a href="index.php?action=create">Créer un post</a></p>
    </body>
</html>
