<?php

use controller\User;

require_once ('modele/Database.php');


$data = new Database();
    $result = $data->GetPromos();
<<<<<<< HEAD
    print_r($result);
    echo $user->getName();



=======
    print_r($result);
>>>>>>> 7bebacc9b07420af7ba64fae0eeb4026d1cce1d7
