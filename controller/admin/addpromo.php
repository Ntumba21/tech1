<?php
    require_once ('..\..\modele\Database.php');
    require_once ('..\..\controller\session.php');
    if (isset($_POST["addpromo"])){
        $data = new Database();
        $admin = $data->AddPromo($_POST["addpromo"]);
        $_SESSION['alert'] = 'Donnée ajoutée';

    }else{
        $_SESSION['alert'] = 'Donnée pas ajoutée';
    }
      
