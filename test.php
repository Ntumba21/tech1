<?php

require_once ('modele/Database.php');
$data = new Database();
$showuser = $data->ShowMaxUser();
var_dump($showuser);