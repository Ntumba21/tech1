<?php require_once("../../controller/session.php");  require_once ("../../controller/admin/showuser.php");
//if(!VerifySession()){header('Location: index.html');}?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../../view/admin/style/user.css">
</head>  
<h1>Bloquer un utilisateur</h1>
    <div class="textbox">


</div>
<div class="container">
<div class="form">
                        
<form action="../../controller/admin/blockuser.php" method="post" name="bloqer">
                            <table>
                                <tr>
                                    <th>block</th>
                                    <th>nom</th>
                                    <th>prenom</th>
                                    <th>mail</th>
                                    <th>Année de naissance</th>
                                    <th>Description</th>
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

  
</body>
</html>





   