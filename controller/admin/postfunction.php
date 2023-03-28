<?php
require_once ('..\..\modele\Database.php');
function ShowAllPost(): void
{
    $data = new Database();
    $post = $data->ShowPost();
    foreach ($post as $row) {
        echo "<tr>";
        echo "<td> <input type='checkbox' name='idpost[]' value='{$row['idpost']}'</td>";
        echo "<td>{$row['type']}</td>";
        echo "<td>{$row['titre']}</td>";
        echo "<td>{$row['contenu']}</td>";
        echo "<td>{$row['date']}</td>";
        echo "<td>{$row['photo']}</td>";
        echo "<td>{$row['nblike']}</td>";
        echo "<td>{$row['nbdislike']}</td>";
        if($row['for'] == 0){
            echo "<td>Tous</td>";
        }
        elseif ($row['for'] == 1){
            echo "<td>Eleves</td>";
        }
        else{
            echo "<td>Proffeseur</td>";
        }
        echo "<td>{$row['interests']}</td>";
        echo "</tr>";
    }
}
function ShowPostinlist(){
    $data = new Database();
    $posts = $data->ShowPost();
    foreach($posts as $post){
        echo '<option value="'.$post['idpost'].'">'.$post['titre'].'</option>';
    }
}