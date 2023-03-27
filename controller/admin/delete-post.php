<?php
require_once ('..\..\modele\Database.php');
require_once ('..\..\controller\session.php');

if(isset($_POST['submit'])){
    if(isset($_POST['idpost'])){
        $data = new Database();
        $data->DeletePost($_POST['idpost']);
        header('Location: delete-delete-post.php');
    }
}

