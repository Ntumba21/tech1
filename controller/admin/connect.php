<?php
    require_once ('..\..\modele\Database.php');
    require_once ('..\..\controller\session.php');
    if (isset($_POST['mail'])&& $_POST['password']){
        $data = new Database();
        $admin = $data->ConnectAdmin($_POST['mail'], $_POST['password']);
        if (count($admin) >0){
           Session($admin[0]["mail"],$admin[0]["password"],true);
           redirectToHomeAdmin();
        }else{
            echo "pas d'utilisateur";

        }


}
