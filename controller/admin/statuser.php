<?php
require_once ('..\..\modele\Database.php');
function MakeStatForMessage(){
    $data = new Database();
    $user = $data->StatUserMessage();
    foreach ($user as $row){
        echo "<tr>";
            echo "<td>{$row['mail']}</td>";
            echo "<td>{$row['message_count']}</td>";
        echo "</tr>";
    }
}
function MakeStatForFriendship(){
    $data = new Database();
    $user = $data->StatUserFriend();
    foreach ($user as $row){
        echo "<tr>";
            echo "<td>{$row['mail']}</td>";
            echo "<td>{$row['num_friends']}</td>";
        echo "</tr>";
    }
}
function MakeStaForMessagePerDay(){
    $data = new Database();
    $Stats = $data->StatForMessagePerDay();
    $date = array();
    $message = array();
    foreach ($Stats as $stat){
        $date[] = $stat['date'];
        $message[] = $stat['message_count'];
    }
    echo "<script>
                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels:".json_encode($date).",
                                datasets: [{
                                    label: 'Nombre de message par mois',
                                    data: ".json_encode($message).",
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>";


}
