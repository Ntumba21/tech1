<?php

class Database
{
    private static $dns;
    private static $user;
    private static $password;
    private static $database;
    private static $port;
    private static $bdd;

    public function __construct()
    {
        self::$dns ="mysql:host=localhost;dbname=projet-tech;port=3306"; // À changer selon vos configurations
        self::$user = "root"; // À changer selon vos configurations
        self::$password = ""; // À changer selon vos configurations
        self::$database = new PDO(self::$dns, self::$user, self::$password);
    }
    public function getUser(){
        $sql = 'SELECT * FROM user';
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getUserByType($type){
        $sql = 'SELECT * FROM user WHERE type = :type';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Ashley 
    public function setUserInactive($id) {
        $sql='UPDATE user 
              SET isvalide = 0, inactive_time = NOW() 
              WHERE iduser = :id';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
      }
    
    public function setUserActive($id) {
        $sql='UPDATE user 
              SET isvalide = 1, inactive_time = NULL 
              WHERE iduser = :id';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
      }
      public function activateAccount($email, $token) {
            $sql='UPDATE user 
                  SET isvalide = 1, token = NULL 
                  WHERE mail = :email AND token = :token';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            return $stmt->rowCount();
      }
      public function DeleteUserById($user_id){
          $sql2 = "DELETE FROM user_has_promos WHERE iduser = :user";
            $stmt2 = self::$database->prepare($sql2);
            $stmt2->bindParam(':user', $user_id);
            $stmt2->execute();
          $sql3 = "DELETE FROM user_has_promos WHERE iduser = :user";
            $stmt3 = self::$database->prepare($sql3);
            $stmt3->bindParam(':user', $user_id);
            $stmt3->execute();
          $sql = "DELETE FROM user WHERE iduser = :user";
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':user', $user_id);
            $stmt->execute();
        return true;
    }

    
    public function getUserByEmaill($email) {
      $sql = 'SELECT * FROM user WHERE mail = ?';
      $stmt = self::$database->prepare($sql);
      $stmt->execute(array($email));
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }
    public function resetPassword($email, $password){
        $sql = 'UPDATE user SET password = :password WHERE mail = :email';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return true;
    }
    //MANAL POUR EDITPROFIL
    
    

    public function AlterUser($nom, $prenom, $mail, $date_de_naissance, $description, $ville, $interests, $photo, $idpromos)
    {
        try {
            
            $sql = 'UPDATE user SET nom = :nom, prenom = :prenom, date_de_naissance = :date_de_naissance,  description = :description, ville = :ville, interests = :interests, photo = :photo WHERE mail = :mail';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':date_de_naissance', $date_de_naissance);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':interests', $interests);
            $stmt->bindParam(':photo', $photo);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
            return false;
        }
    }

    public function createUser($nom, $prenom, $mail, $password, $date_de_naissance, $type, $description, $ville, $interests, $photo, $isvalide, $token) {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql='INSERT INTO user (nom, prenom, mail, password, date_de_naissance, type, description, ville, interests, photo, isvalide,token) 
                  VALUES (:nom, :prenom, :mail, :hashed_password, :date_de_naissance, :type, :description, :ville, :interests, :photo, :isvalide, :token)';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':hashed_password', $hashed_password);
            $stmt->bindParam(':date_de_naissance', $date_de_naissance);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':interests', $interests);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':isvalide', $isvalide);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
            return false;
        }        
    }
    public function registerPromo($mail, $idpromos){
        $stmt2 = self::$database->prepare('SELECT iduser FROM user WHERE mail = :mail');
        $stmt2->bindParam(':mail', $mail);
        $stmt2->execute();
        $iduser = $stmt2->fetch();
        $iduser = $iduser[0];
        $sql = 'INSERT INTO `user_has_promos` (`iduser`, `idpromos`) 
                VALUES (:iduser, :idpromos)';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':iduser', $iduser);
        $stmt->bindParam(':idpromos', $idpromos);
        $stmt->execute();
        return true;
    }
    
    //je travail ici MANAL
    public function GetUsersByID($id){
        $sql = 'SELECT * FROM user WHERE iduser = :id';
        $statement = self::$database->prepare($sql);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function getUserByEmail($mail){
        $sql = 'SELECT * FROM user WHERE mail = :mail';
        $statement = self::$database->prepare($sql);
        $statement->bindParam(":mail", $mail, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function Connect($mail, $password){
        $sql = "SELECT * FROM `user`
                WHERE mail = :mail
                AND password = :password
                AND isvalide = 1";
        $statement = self::$database->prepare($sql);
        $statement->execute(array(":mail" => $mail, ":password" => $password));
        return $statement->fetchAll();
    }
    //manal 
    public function GetPromos(){
        $sql = "SELECT * FROM promos";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function GetPromosByID($iduser){
        $sql = "SELECT idpromos FROM user_has_promos WHERE iduser = :iduser";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':iduser', $iduser);
        $stmt->execute();
        $idpromos = $stmt->fetchAll();
        $idpromos = $idpromos[0]['idpromos'];
        $sql = "SELECT nom FROM promos WHERE idpromos = :idpromos";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpromos', $idpromos);
        $stmt->execute();
        return $stmt->fetchAll();

    }


    //Admin function

    public function DeletePromo($nom){
        $sql = "DELETE FROM promos WHERE nom = :nom";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        return true;
    }
    public function AddPromo($nom){
        $sql = "INSERT INTO promos (nom) VALUES (:nom)";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        return true;
    }
    public function ConnectAdmin($mail, $password){
        $sql = "SELECT * FROM admin WHERE mail = :mail AND password = :password";
        $stmt = self::$database->prepare($sql);
        $stmt->execute(['mail' => $mail, 'password' => $password]);
        return $stmt-> fetchAll();
    }
    public function CreatePostforAll($type,$titre, $contenu, $date, $lieu, $photo, $mail){
        $for = 0;
        $sql = "INSERT INTO post (type, titre, contenu, date, lieu, photo, for) 
                VALUES (:type, :titre, :contenu, :date, :lieu, :photo, :for)";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':lieu', $lieu);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':for', $for);
        $stmt->execute();
        $sql2 = "SELECT idpost FROM post WHERE titre = :titre";
        $stmt2 = self::$database->prepare($sql2);
        $stmt2->bindParam(':titre', $titre);
        $stmt2->execute();
        $idpost = $stmt2->fetch();
        $sql3 = "SELECT iduser FROM user WHERE mail = :mail";
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':mail', $mail);
        $stmt3->execute();
        $iduser = $stmt3->fetch();
        $iduser = $iduser[0];
        $sql4 = "INSERT INTO post_admin (idpost, idAdmin) VALUES (:idpost, :idadmin)";
        $stmt4 = self::$database->prepare($sql4);
        $stmt4->bindParam(':idpost', $idpost[0]);
        $stmt4->bindParam(':idadmin', $iduser);
        $stmt4->execute();
        return true;
    }
    public function CreatePostforProf($type,$titre, $contenu, $date, $lieu, $photo, $mail){
        $for = 2;
        $sql = "INSERT INTO post (type, titre, contenu, date, lieu, photo, for) 
                VALUES (:type, :titre, :contenu, :date, :lieu, :photo, :for)";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':lieu', $lieu);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':for', $for);
        $stmt->execute();
        $sql2 = "SELECT idpost FROM post WHERE titre = :titre";
        $stmt2 = self::$database->prepare($sql2);
        $stmt2->bindParam(':titre', $titre);
        $stmt2->execute();
        $idpost = $stmt2->fetch();
        $sql3 = "SELECT iduser FROM user WHERE mail = :mail";
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':mail', $mail);
        $stmt3->execute();
        $iduser = $stmt3->fetch();
        $iduser = $iduser[0];
        $sql4 = "INSERT INTO post_admin (idpost, idAdmin) VALUES (:idpost, :idadmin)";
        $stmt4 = self::$database->prepare($sql4);
        $stmt4->bindParam(':idpost', $idpost[0]);
        $stmt4->bindParam(':idadmin', $iduser);
        $stmt4->execute();
        return true;
    }

    public function CreatePostforStudent($type,$titre, $contenu, $date, $lieu, $photo){
        $for = 1;
        $sql = "INSERT INTO post (type, titre, contenu, date, lieu, photo, for) 
                VALUES (:type, :titre, :contenu, :date, :lieu, :photo, :for)";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':lieu', $lieu);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':for', $for);
        $stmt->execute();
        $sql2 = "SELECT idpost FROM post WHERE titre = :titre";
        $stmt2 = self::$database->prepare($sql2);
        $stmt2->bindParam(':titre', $titre);
        $stmt2->execute();
        $idpost = $stmt2->fetch();
        $sql3 = "SELECT iduser FROM user WHERE mail = :mail";
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':mail', $mail);
        $stmt3->execute();
        $iduser = $stmt3->fetch();
        $iduser = $iduser[0];
        $sql4 = "INSERT INTO post_admin (idpost, idAdmin) VALUES (:idpost, :idadmin)";
        $stmt4 = self::$database->prepare($sql4);
        $stmt4->bindParam(':idpost', $idpost[0]);
        $stmt4->bindParam(':idadmin', $iduser);
        $stmt4->execute();
        return true;
    }
    public function ShowPostAdmin(){
        $sql = "SELECT * FROM post 
                inner join post_admin on post.idpost = post_admin.idpost 
                WHERE idadmin = :idadmin 
                ORDER BY date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idadmin', $_SESSION['iduser']);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    // post fonction user
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
    public function ShowPost(){
        $sql = "SELECT * FROM post ORDER BY date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function ShowPostByUSer($iduser){
        $sql = "SELECT * FROM post 
                inner join post_user on post.idpost = post_user.idpost 
                WHERE iduser = :iduser ORDER BY date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':iduser', $iduser);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function ShowPostByType($type){
        $sql = "SELECT * FROM post WHERE type = :type ORDER BY date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //amitier
    public function defaultFriend($mail, $idpromo){
        $sql = "SELECT * FROM user WHERE idpromo = :idpromo";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpromo', $idpromo);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $sql2 = "SELECT iduser FROM user WHERE mail = :mail";
        $stmt2 = self::$database->prepare($sql2);
        $stmt2->bindParam(':mail', $mail);
        $stmt2->execute();
        $iduser = $stmt2->fetch();
        $iduser = $iduser[0];
        foreach ($result as $key => $value) {
            $sql3 = "INSERT INTO amis (iduser1, iduser2) VALUES (:iduser1, :iduser2)";
            $stmt3 = self::$database->prepare($sql3);
            $stmt3->bindParam(':iduser1', $iduser);
            $stmt3->bindParam(':iduser2', $value['iduser']);
            $stmt3->execute();
        }
    }

    //ash

    public function sendMessage($sender_id, $receiver_id, $content) {
        $sql = "INSERT INTO message (contenu, date, iduser, idamis) VALUES (:content, NOW(), :sender_id, :receiver_id)";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':sender_id', $sender_id);
        $stmt->bindParam(':receiver_id', $receiver_id);
        $stmt->execute();
    }

    public function getMessagesBetweenUsers($sender_id, $receiver_id) {
        $sql= "SELECT * FROM message WHERE (iduser = :sender_id AND idamis = :receiver_id) OR (iduser = :receiver_id AND idamis = :sender_id) ORDER BY date ASC";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':sender_id', $sender_id);
        $stmt->bindParam(':receiver_id', $receiver_id);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }

    public function defaultamitié2($mail){
        $stmt2 = self::$database->prepare('SELECT iduser FROM user WHERE mail = :mail');
        $stmt2->bindParam(':mail', $mail);
        $stmt2->execute();
        $iduser = $stmt2->fetchColumn();
    
        $stmt2 = self::$database->prepare('SELECT idpromos FROM user_has_promos WHERE iduser = :id');
        $stmt2->bindParam(':id', $iduser);
        $stmt2->execute();
        $idpromo = $stmt2->fetchColumn();
    
        $sql2 = "SELECT iduser FROM user_has_promos WHERE idpromos = :promo";
        $stmt2 = self::$database->prepare($sql2);
        $stmt2->bindParam(':promo', $idpromo);
        $stmt2->execute();
    
        while ($idami = $stmt2->fetchColumn()) {
            if ($idami != $iduser) {
                $stmt3 = self::$database->prepare('INSERT INTO amis (idamis) VALUES (:idami)');
                $stmt3->bindParam(':idami', $idami);
                $stmt3->execute();
    
                $idamis = self::$database->lastInsertId();
    
                $sql = 'INSERT INTO `user_has_amis` (`iduser`, `idamis`) 
                        VALUES (:iduser, :idamis)';
                $stmt = self::$database->prepare($sql);
                $stmt->bindParam(':iduser', $iduser);
                $stmt->bindParam(':idamis', $idamis);
                $stmt->execute();
            }
        }
    
        return true;
    
    }


    public function addFriend($user_email, $friend_email) {
        // Get the user IDs for both the user and the friend
        $stmt = self::$database->prepare('SELECT iduser FROM user WHERE mail = :email');
        $stmt->bindParam(':email', $user_email);
        $stmt->execute();
        $user_id = $stmt->fetchColumn();
    
        $stmt->bindParam(':email', $friend_email);
        $stmt->execute();
        $friend_id = $stmt->fetchColumn();
    
        if (!$user_id || !$friend_id) {
            return false; // Either the user or the friend was not found
        }
    
        // Il faut voir si les amis sont dans la table amis !! je vous deteste
        $stmt = self::$database->prepare('SELECT idamis FROM amis WHERE idamis = :iduser');
        $stmt->bindParam(':iduser', $friend_id);
        $stmt->execute();
        $idamis = $stmt->fetchColumn();
    
        if (!$idamis) {
            // sinon on l'ajoute, je vous hai
            $stmt = self::$database->prepare('INSERT INTO amis (idamis) VALUES (:iduser)');
            $stmt->bindParam(':iduser', $friend_id);
            $stmt->execute();
            $idamis = self::$database->lastInsertId();
        }
    
        // voir si les amis sont deja amis BANDE DE MECHANT
        $stmt = self::$database->prepare('SELECT COUNT(*) FROM user_has_amis WHERE iduser = :user_id AND idamis = :idamis');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':idamis', $idamis);
        $stmt->execute();
        $alreadyConnected = $stmt->fetchColumn() > 0;
    
        if (!$alreadyConnected) {
            //sinon on peut inserer dans userhasamis
            $stmt = self::$database->prepare('INSERT INTO user_has_amis (iduser, idamis) VALUES (:user_id, :idamis)');
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':idamis', $idamis);
            $stmt->execute();
        }
    
        return true;
    }
    
    

   

    
}
    








