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
        self::$dns ="mysql:host=localhost;dbname=projet-tech;port=3307"; // À changer selon vos configurations
        self::$user = "root"; // À changer selon vos configurations
        self::$password = ""; // À changer selon vos configurations
        self::$database = new PDO(self::$dns, self::$user, self::$password);
    }
    public function getUser(){
        $sql = 'SELECT * FROM user';
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        $sql4 = "DELETE FROM amis INNER JOIN user_has_amis ON amis.idamis = user_has_amis.idamis WHERE user_has_amis.iduser = :user";
            $stmt4 = self::$database->prepare($sql4);
            $stmt4->bindParam(':user', $user_id);
            $stmt4->execute();
        $sql1 = "DELETE FROM user_has_amis WHERE iduser = :user";
            $stmt1 = self::$database->prepare($sql1);
            $stmt1->bindParam(':user', $user_id);
            $stmt1->execute();
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

    public function AlterUser($description, $ville, $interests, $photo,$mail)
    {
        try {
            
            $sql = 'UPDATE user SET description = :description, ville = :ville, interests = :interests, photo = :photo WHERE mail = :mail';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':interests', $interests);
            $stmt->bindParam(':photo', $photo);
            $stmt->bindParam(':mail', $mail); 
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

    //Admin function
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
    //admin stat
    public function ShowMaxUser(){
        $sql = "SELECT COUNT(iduser) FROM user";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        $var =  $stmt->fetchAll();
        return $var[0][0];
    }
    public function StatUserFriend(){
        $sql = "SELECT user.mail, COUNT(user_has_amis.iduser) as num_friends 
                FROM user
                JOIN user_has_amis ON user_has_amis.iduser_friend = user.iduser
                GROUP BY user.iduser
                ORDER BY num_friends DESC
                LIMIT 5";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function StatUserMessage(){
        $sql = "SELECT user.mail, COUNT(*) AS message_count
                FROM message
                JOIN user ON message.iduser = user.iduser
                GROUP BY user.iduser
                ORDER BY message_count DESC
                LIMIT 5;";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function DeletePost($idpost){
        $sql1= "DELETE FROM post_user WHERE idpost = :idpost";
        $stmt1 = self::$database->prepare($sql1);
        $stmt1->bindParam(':idpost', $idpost);
        $stmt1->execute();
        $sql2 = "DELETE FROM post_admin WHERE idpost = :idpost";
        $stmt2 = self::$database->prepare($sql2);
        $stmt2->bindParam(':idpost', $idpost);
        $stmt2->execute();
        $sql3 = "DELETE FROM post_has_lieu WHERE idpost = :idpost";
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':idpost', $idpost);
        $stmt3->execute();
        $sql4 = "DELETE FROM notification WHERE idpost = :idpost";
        $stmt4 = self::$database->prepare($sql4);
        $stmt4->bindParam(':idpost', $idpost);
        $stmt4->execute();
        $sql5 = "DELETE FROM reactions WHERE idpost = :idpost";
        $stmt5 = self::$database->prepare($sql5);
        $stmt5->bindParam(':idpost', $idpost);
        $stmt5->execute();
        $sql = "DELETE FROM post WHERE idpost = :idpost";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->execute();
        return true;
    }


    //ash AMITIÉ

    public function defaultFriend($mail){
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
    
                $sql = 'INSERT INTO `user_has_amis` (`iduser`, `idamis`,`statut`) 
                        VALUES (:iduser, :idamis , :accepter)';
                $stmt = self::$database->prepare($sql);
                $stmt->bindParam(':iduser', $iduser);
                $stmt->bindParam(':idamis', $idami);
                $accepter=1;
                $stmt->bindParam(':accepter',$accepter);
                $stmt->execute();
            }
        }
    
        return true;
    
    }


    public function addFriend($user_email, $friend_email) {
        $stmt = self::$database->prepare('SELECT iduser FROM user WHERE mail = :email');
        $stmt->bindParam(':email', $user_email);
        $stmt->execute();
        $user_id = $stmt->fetchColumn();
    
        $stmt->bindParam(':email', $friend_email);
        $stmt->execute();
        $friend_id = $stmt->fetchColumn();
    
        if (!$user_id || !$friend_id) {
            return false; 
        }
        if ($user_email == $friend_email) {
            return false;
        }
    
        // voir si les amis sont deja amis
        $stmt = self::$database->prepare('SELECT COUNT(*) FROM user_has_amis WHERE (iduser = :user_id AND idamis = :idamis) OR (iduser = :idamis AND idamis = :user_id)');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':idamis', $friend_id);
        $stmt->execute();
        $alreadyConnected = $stmt->fetchColumn() > 0;
    
        if (!$alreadyConnected) {
            //sinon on peut inserer dans userhasamis
            $stmt = self::$database->prepare('INSERT INTO user_has_amis (iduser, idamis,statut) VALUES (:user_id, :idamis, :attente)');
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':idamis',  $friend_id);
            $attente=2;
            $stmt->bindParam(':attente',$attente);
            $stmt->execute();
            return true;
        }else{
            return false;
        }
    }

    public function getFriendRequests($id) {

        $stmt = self::$database->prepare('SELECT iduser FROM user_has_amis WHERE idamis = :id AND statut = 2');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getFriendRequestsAll($id) {
        $stmt = self::$database->prepare('SELECT iduser FROM user_has_amis WHERE idamis = :id AND statut = 2');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $idDemandes = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        $friendRequests = [];
        foreach ($idDemandes as $idDemande) {
            $stmt = self::$database->prepare('SELECT * FROM user WHERE iduser = :id');
            $stmt->bindParam(':id', $idDemande);
            $stmt->execute();
            $friendRequests[] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        return $friendRequests;
    }
    

    public function acceptFriendRequest($requester_id, $user_id) {
        $stmt = self::$database->prepare('UPDATE user_has_amis
                                SET statut = 1
                                WHERE iduser = :requester_id AND idamis = :user_id AND statut = 2');
        $stmt->bindParam(':requester_id', $user_id);
        $stmt->bindParam(':user_id', $requester_id);
        $stmt->execute();
    }

    public function rejectFriendRequest($requester_id, $user_id) {
        $stmt = self::$database->prepare('DELETE FROM user_has_amis
                                WHERE iduser = :requester_id AND idamis = :user_id AND statut = 2');
        $stmt->bindParam(':requester_id', $user_id);
        $stmt->bindParam(':user_id', $requester_id);
        $stmt->execute();
    }
    public function affichefriends($id) {
        $stmt = self::$database->prepare('SELECT iduser FROM user_has_amis WHERE idamis = :id AND statut = 1');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $idAmis = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $friends = [];
        foreach ($idAmis as $idAmi) {
            $stmt = self::$database->prepare('SELECT * FROM user WHERE iduser = :id');
            $stmt->bindParam(':id', $idAmi);
            $stmt->execute();
            $friends[] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        return $friends;
    }
    

  //Message
    public function getUserById($id) {
        $sql = "SELECT * FROM user WHERE iduser = :id";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMessages($id_user, $id_amis) {
        $sql = "SELECT * FROM message WHERE (iduser = :id_user AND idamis  = :id_amis) OR (iduser = :id_amis AND idamis = :id_user) ORDER BY date ASC";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_amis', $id_amis);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sendMessage($id_user, $id_amis, $message) {
        $sql = "INSERT INTO message (iduser, idamis, contenu, date) VALUES (:id_user, :id_amis, :message, NOW())";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_amis', $id_amis);
        $stmt->bindParam(':message', $message);

        return $stmt->execute();
    }


    //create contenu
    public function CreatePost2($type,$titre, $contenu, $date,$lieu, $photo, $iduser,$etiquette){
        $sql5 = 'SELECT idamis FROM user_has_amis WHERE (iduser= :iduser AND idamis= :idamis) OR (iduser= :idamis AND idamis= :iduser) AND statut=1';
        $stmt = self::$database->prepare($sql5);
        $stmt->bindParam(':iduser', $iduser);
         $stmt->bindParam(':idamis', $etiquette);
        $stmt->execute();
        $result=$stmt->fetch();

        if (!$result){
         return false;
     } else {
         $idAmis= $result['idamis'];
     }

        $sql = "INSERT INTO post (type, titre, contenu, date, photo,etiquette) 
                VALUES (:type, :titre, :contenu, :date, :photo,:etiquette)";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':etiquette', $idAmis);
        $stmt->execute();

        $idpost = self::$database->lastInsertId();

        $sql4 = "INSERT INTO post_user (idpost, iduser) VALUES (:idpost, :iduser)";
        $stmt4 = self::$database->prepare($sql4);
        $stmt4->bindParam(':idpost', $idpost);
        $stmt4->bindParam(':iduser', $iduser);
        $stmt4->execute();

        $sql5 = 'SELECT idlieu FROM lieu WHERE nom = :nom';
        $stmt = self::$database->prepare($sql5);
        $stmt->bindParam(':nom', $lieu);
        $stmt->execute();
        $result=$stmt->fetch();

        if (!$result){
        $sql = 'INSERT INTO `lieu` (`nom`) 
                VALUES (:nom)';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':nom', $lieu);
        $stmt->execute();
        $idlieu = self::$database->lastInsertId();
    } else {
        // Le lieu existe déjà dans la base de données, on récupère son ID
        $idlieu = $result['idlieu'];
    }

        $sql = 'INSERT INTO `post_has_lieu` (`idlieu`, `idpost`) 
        VALUES (:idlieu, :idpost)';
       $stmt = self::$database->prepare($sql);
       $stmt->bindParam(':idlieu', $idlieu);
       $stmt->bindParam(':idpost', $idpost);
       $idlieu=$stmt->execute();


        return true;
    }


    //Voir ses postes

    public function showPostUser($id){
        $sql4 = "SELECT p.* FROM post_user pu 
        JOIN post p ON pu.idpost = p.idpost 
        WHERE pu.iduser = :iduser 
        ORDER BY p.date DESC";
        $stmt4 = self::$database->prepare($sql4);
        $stmt4->bindParam(':iduser', $id);
        $stmt4->execute();
        $posts = $stmt4->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }





    public function listerNonAmis($userId)
    {
        $reg = self::$database->prepare("SELECT * FROM user WHERE iduser NOT IN (SELECT idamis FROM user_has_amis WHERE iduser = ? AND statut = 1) AND iduser NOT IN (SELECT iduser FROM user_has_amis WHERE idamis = ? AND statut = 1) AND iduser NOT IN (SELECT iduser FROM user_has_amis WHERE idamis = ? AND statut = 2) AND iduser NOT IN (SELECT idamis FROM user_has_amis WHERE iduser = ? AND statut = 2) AND iduser != ?");
        $reg->execute(array($userId, $userId, $userId));
        return $reg->fetchAll();
    }

    public function listerAmis($userId)
    {
        $reg = self::$database->prepare("SELECT * FROM user WHERE iduser IN (SELECT idamis FROM user_has_amis WHERE iduser = ? AND statut = 1) AND iduser IN (SELECT iduser FROM user_has_amis WHERE idamis = ? AND statut = 1) AND iduser != ?");
        $reg->execute(array($userId, $userId, $userId));
        return $reg->fetchAll();
    }
    





    //BON
    
    //Pour les users recherche mais pas utilise RECHERCHE SUR TT LES UTILISATEURS
    
    public function rechercherUtilisateur($utilisateur)
    {
        $reg = self::$database->prepare("SELECT * FROM user WHERE nom LIKE ? LIMIT 10");
        $reg->execute(array("%$utilisateur%"));
        return $reg->fetchAll();
    }


        //MARCHE 
        public function rechercherNonAmis($utilisateur, $userId)
        {
            // Recherche des utilisateurs avec le nom similaire
            $reg = self::$database->prepare("SELECT * FROM user WHERE nom LIKE ? LIMIT 10");
            $reg->execute(array("%$utilisateur%"));
            $users = $reg->fetchAll();
        
            $nonAmis = array();
        
            foreach ($users as $user) {
                // Vérification si l'utilisateur est un ami
                $reg = self::$database->prepare("SELECT COUNT(*) FROM user_has_amis WHERE (iduser = ? AND idamis = ? AND statut IN (1, 2)) OR (iduser = ? AND idamis = ? AND statut IN (1, 2))");
                $reg->execute(array($userId, $user['iduser'], $user['iduser'], $userId));
                $isAmi = $reg->fetchColumn() > 0;
        
                // Si ce n'est pas un ami, ajoutez-le à la liste des non-amis
                if (!$isAmi) {
                    $nonAmis[] = $user;
                }
            }
        
            return $nonAmis;
        }

//BON

public function ajouterAmi($userId, $amiId)
{
        // voir si les amis sont deja amis
        $stmt = self::$database->prepare('SELECT COUNT(*) FROM user_has_amis WHERE (iduser = :user_id AND idamis = :idamis) OR (iduser = :idamis AND idamis = :user_id)');
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':idamis', $amiId);
        $stmt->execute();
        $alreadyConnected = $stmt->fetchColumn() > 0;
    
        if (!$alreadyConnected) {
            //sinon on peut inserer dans userhasamis
            $stmt = self::$database->prepare('INSERT INTO user_has_amis (iduser, idamis,statut) VALUES (:user_id, :idamis, :attente)');
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':idamis',  $amiId);
            $attente=2;
            $stmt->bindParam(':attente',$attente);
            $stmt->execute();
            return true;
        }else{
            return false;
        }
    }


  //BON

    public function rechercheAmis($utilisateur, $userId)
    {
        // Recherche des utilisateurs avec le nom similaire
        $reg = self::$database->prepare("SELECT * FROM user WHERE nom LIKE ? LIMIT 10");
        $reg->execute(array("%$utilisateur%"));
        $users = $reg->fetchAll();
    
        $amis = array();
    
        foreach ($users as $user) {
            // Vérification si l'utilisateur est un ami
            $reg = self::$database->prepare("SELECT COUNT(*) FROM user_has_amis WHERE (iduser = ? AND idamis = ? AND statut = 1) OR (iduser = ? AND idamis = ? AND statut =1)");
            $reg->execute(array($userId, $user['iduser'], $user['iduser'], $userId));
            $isAmi = $reg->fetchColumn() > 0;
    
            // Si c'est un ami, ajoutez-le à la liste des amis
            if ($isAmi) {
                $amis[] = $user;
            }
        }
    
        return $amis;
    }
    



    public function alterPost($idpost, $iduser, $nouveauTitre, $nouveauContenu) {
        // Vérifier si l'utilisateur connecté est l'auteur de ce post
        $sql = "SELECT iduser FROM post_user WHERE idpost = :idpost";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result['iduser'] !== $iduser) {
            // L'utilisateur connecté n'est pas l'auteur de ce post, retourner une erreur
            return "Vous n'êtes pas autorisé à modifier ce post.";
        }
    
        // Mettre à jour le post avec les nouvelles données
        $sql = "UPDATE post SET titre = :nouveauTitre, contenu = :nouveauContenu WHERE idpost = :idpost";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->bindParam(':nouveauTitre', $nouveauTitre);
        $stmt->bindParam(':nouveauContenu', $nouveauContenu);
        $stmt->execute();
    
        return "Post mis à jour avec succès !";
    }
    

    
}
    








