<?php
require_once ('modele\Database.php');
 $data = new Database();
    $result = $data->GetPromos();
    print_r($result);