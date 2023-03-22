<?php
    require_once '../modele/Database.php';
    function ShowPrmo(){
        $db = new Database();
        $promos = $db->GetPromos();
        foreach($promos as $promo){
            echo '<option value="'.$promo['idpromos'].'">'.$promo['nom'].'</option>';
        }
    }