<?php
    require_once('..\modele\Database.php');
    require_once('..\controller\session.php');
    function ShowPromoEleve(): void
    {
        $db = new Database();
        $promos = $db->GetPromos();
        echo '<select name="idpromos">';
        foreach($promos as $promo){
            echo '<option value="'.$promo['idpromos'].'">'.$promo['nom'].'</option>';
        }
        echo '</select>';
    }
    function ShowPromoProf(): void
    {
        $db = new Database();
        $promos = $db->GetPromos();
        foreach($promos as $promo){
            echo '<input type="checkbox" name="idpromos[]" value="'.$promo['idpromos'].'">'.$promo['nom'];
        }
    }