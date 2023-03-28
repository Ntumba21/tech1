<?php
require_once ('..\..\modele\Database.php');
require_once ('..\..\controller\session.php');
if(isset($_POST['submit'])){
    var_dump($_POST);
    $redirection = "../../view/admin/alter-post.php?idpost={$_POST['idpost']}";
    header("Location: {$redirection}");
}
