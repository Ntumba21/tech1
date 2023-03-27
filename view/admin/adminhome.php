<?php require_once '../../controller/session.php';
//pour verifier si la session est valide
//if(!VerifySession()){header('Location: index.html');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../view/style/sup.css">
</head>
<body>
<header>
    <img src="../../media/logo ECEBOOK.png" alt="Logo" class="logo">
    <h1>Welcome Admin</h1>
</header>
<div class="content">
    <div class="square">

</head>
<body>
<?php include_once 'create-post.php'; ?>
<?php include_once 'delete-post.php'; ?>
<?php //include_once 'update-delete-post.php'; ?>
<?php include_once 'statistique.php'; ?>
<?php include_once 'promo.php'; ?>
<?php include_once 'manage-user.php'; ?>
</body>
</div>
</div>
</body>
<footer>
<a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
</footer>
</html>