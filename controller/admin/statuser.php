<?php
require_once ('..\..\modele\Database.php');
function MakeStatForMessage(){
    $data = new Database();
    $user = $data->StatUserMessage();
    foreach ($user as $row){
        echo "<tr>";
            echo "<td>{$row['user.mail']}</td>";
            echo "<td>{$row['message_count']}</td>";
        echo "</tr>";
    }
}
function MakeStatForFriendship(){
    $data = new Database();
    $user = $data->StatUserFriend();
    foreach ($user as $row){
        echo "<tr>";
            echo "<td>{$row['user.mail']}</td>";
            echo "<td>{$row['num_friends ']}</td>";
        echo "</tr>";
    }
}
