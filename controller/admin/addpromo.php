<?php
    require_once ('..\..\modele\Database.php');
    require_once ('..\..\controller\session.php');
    if (isset($_POST["promos"])){
        $data = new Database();
        $admin = $data->AddPromo($_POST["promos"]);
        //echo $_POST["promos"];
        echo 'Donnée ajoutée';

    }else{
        echo 'Donnée pas ajoutée';
    }
      
?>