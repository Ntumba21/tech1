<?php

use controller\User;

require_once ('modele\Database.php');
require_once ('controller\user.php');


$user = new User();
$user->MakeUser('manal.melgou@edu.ece.fr');
 $data = new Database();
    $result = $data->GetPromos();
    print_r($result);
    echo $user->getName();



    public function CreatePost($type,$titre, $contenu, $date, $lieu, $photo, $mail){
      $sql = "INSERT INTO post (type, titre, contenu, date, lieu, photo) 
              VALUES (:type, :titre, :contenu, :date, :lieu, :photo)";
      $stmt = self::$database->prepare($sql);
      $stmt->bindParam(':type', $type);
      $stmt->bindParam(':titre', $titre);
      $stmt->bindParam(':contenu', $contenu);
      $stmt->bindParam(':date', $date);
      $stmt->bindParam(':lieu', $lieu);
      $stmt->bindParam(':photo', $photo);
      $stmt->execute();
      $sql2 = "SELECT idpost FROM post WHERE titre = :titre";
      $stmt2 = self::$database->prepare($sql2);
      $stmt2->bindParam(':titre', $titre);
      $stmt2->execute();
      $idpost = $stmt2->fetch();
      $sql3= "SELECT iduser FROM user WHERE mail = :mail";
      $stmt3 = self::$database->prepare($sql3);
      $stmt3->bindParam(':mail', $mail);
      $stmt3->execute();
      $iduser = $stmt3->fetch();
      $sql4 = "INSERT INTO post_user (idpost, iduser) VALUES (:idpost, :iduser)";
      $stmt4 = self::$database->prepare($sql4);
      $stmt4->bindParam(':idpost', $idpost[0]);
      $stmt4->bindParam(':iduser', $iduser[0]);
      $stmt4->execute();
      return true;
  }