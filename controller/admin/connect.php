<?php
    require_once ('..\..\modele\Database.php');
    if (isset($_POST['mail'])&& $_POST['password']){
        $data = new Database();
        $admin = $data->ConnectAdmin($_POST['mail'], $_POST['password']);
        if (count($admin) >0){
            print_r ($admin);
//            Session($users[0]["nom_user"],$users[0]["mail_user"],$users[0]["id_user"],true);
            echo "connecté";
//            header("location: ../view/admin/index.html");
        }else{
            echo "pas d'utilisateur";
//            header("location: ../view/admin/index.html");
        }


}