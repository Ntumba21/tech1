<?php
require_once ('..\..\modele\Database.php');
require_once ('..\..\controller\session.php');

if(isset($_POST['submit'])){
    if(isset($_POST['idpost[]'])){
        foreach ($_POST['idpost[]'] as $idpost){
            $data = new Database();
            $data->DeletePost($idpost);
        }
        header('Location: delete-post.php');
    }
}

