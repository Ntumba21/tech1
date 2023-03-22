<?php

use controller\User;

require_once ('modele\Database.php');
require_once ('controller\user.php');


$user = new User();
$user->MakeUser('manal.melgou@edu.ece.fr');
 $data = new Database();
    $result = $data->GetPromos();
    print_r($result);
    echo $user->getName();



