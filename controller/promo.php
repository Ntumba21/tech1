<?php
    require_once '../modele/Database.php';
    function ShowPromo(){
        $db = new Database();
        $promos = $db->GetPromos();
        foreach($promos as $promo){
            echo '<option value="'.$promo['idpromos'].'">'.$promo['nom'].'</option>';
        }
        echo '</select>';
    }
    function ShowPromoProf(){
        $db = new Database();
        $promos = $db->GetPromos();
        foreach($promos as $promo){
            echo '<input type="checkbox" name="idpromos[]" value="'.$promo['idpromos'].'">'.$promo['nom'];
        }
    }