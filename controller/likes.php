<?php
require_once ('../controller/session.php ');
require_once ('../modele/Database.php');
function like($mail,$idpost){
    $like = 1;
    $data = new Database();
    $data->likes($like,$mail,$idpost);

}
function dislike($mail,$idpost){
    $like = 2;
    $data = new Database();
    $data->likes($like,$mail,$idpost);

}
