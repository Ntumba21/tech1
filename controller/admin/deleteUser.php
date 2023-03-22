<?php
    require_once ('..\..\modele\Database.php');
    require_once ('..\..\controller\session.php');
    $data = new Database();
    $admin = $data->DeleteUserById();
       
?>