<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/postfunction.php");
//if(!VerifySession()){header('Location: index.html');}?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../view/style/loginForm.css">
    </head>

<div class="textbox">
<h1>Post</h1>
<h2>ECEBOOK helps you to connect,
    create, delete, modify a post and send message
</h2>
</div>
<div class="container" style="background-color: transparent">
    
<button onclick="window.location.href='create-post'">Créer un post</button>
    <button onclick="window.location.href='delete-post'">Supprimer un post</button>
    
   



        <form name="post" method="post" action="../../controller/admin/show-alter-post.php">
            <label for="idpost">idpost</label>
            <select name="idpost" id="idpost">
                <?php ShowPostinlist(); ?>
            </select>
          <input type="submit" name="submit" value="  Modifier un post">

        </form>
        </div>
    </section>
</main>


