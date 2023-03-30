<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/showuser.php");
//if(!VerifySession()){header('Location: index.html');}?>
<!DOCTYPE html>

<html>
<head>
  
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../view/admin/style/user.css">
</head>  
<h1>Déloquer un utilisateur</h1>
    <div class="textbox">


</div>
<div class="container">
<div class="form">
    <form action="../../controller/admin/deblockuser.php" method="post" name="debloquer">
        <table>
            <tr>
                <th>deblock</th>
                <th>nom</th>
                <th>prenom</th>
                <th>mail</th>
                <th>date_de_naissance</th>
                <th>description</th>
                <th>ville</th>
                <th>interests</th>
                <th>photo</th>
                <th>promos</th>
                <th>isvalide</th>
            </tr>
            <?php ShowBlockUser(); ?>
            </table>

                            <input type="submit" name="submit" value="Debloquer">
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
</html>