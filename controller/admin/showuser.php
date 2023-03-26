<?php
require_once ('..\..\modele\Database.php');
function ShowUser(){
    $data = new Database();
    $user = $data->getUser();
    makeTable($user, $data);
}
function ShowBlockUser(){
    $data = new Database();
    $user = $data->getInactiveUser();
    makeTable($user, $data);
}

/**
 * @param bool|array $user
 * @param Database $data
 * @return void
 */
function makeTable(bool|array $user, Database $data): void
{
    foreach ($user as $row) {
        echo "<tr>";
        echo "<td> <input type='checkbox' name='iduser[]' value='{$row['iduser']}'</td>";
        echo "<td>{$row['nom']}</td>";
        echo "<td>{$row['prenom']}</td>";
        echo "<td>{$row['mail']}</td>";
        echo "<td>{$row['date_de_naissance']}</td>";
        echo "<td>{$row['description']}</td>";
        echo "<td>{$row['ville']}</td>";
        echo "<td>{$row['interests']}</td>";
        echo "<td>{$row['photo']}</td>";
        $promo = $data->GetPromosByID($row['iduser']);
        echo "<td>{$promo[0]['nom']}</td>";
        echo "<td>{$row['isvalide']}</td>";
        echo "</tr>";
    }
}
