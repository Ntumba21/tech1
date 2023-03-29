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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getActiveUser(){
        $sql = 'SELECT * FROM user where isvalide = 1';
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getInactiveUser() {
        $sql = 'SELECT * FROM user WHERE isvalide = 0';
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
    public function getUserById($id) {
        $sql = "SELECT * FROM user WHERE iduser = :id";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserByEmail($email) {
        $sql = 'SELECT * FROM user WHERE mail = ?';
        $stmt = self::$database->prepare($sql);
        $stmt->execute(array($email));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //gestion des comptes du user
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
        $sql2 = 'SELECT iduser FROM user WHERE mail = :mail';
        $stmt2 = self::$database->prepare($sql2);
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
public function Connect($mail, $password){
    $sql = "SELECT * FROM `user`
            WHERE mail = :mail
            AND isvalide = 1";
    $statement = self::$database->prepare($sql);
    $statement->execute(array(":mail" => $mail));
    $user = $statement->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}
    //manal 
    public function GetPromos(){
        $sql = "SELECT * FROM promos";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function GetPromosByID($id){
        $sql = "SELECT * FROM promos WHERE idpromos = :id";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':id', $id);
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
    public function ConnectAdmin($mail) {
        $sql = "SELECT * FROM admin WHERE mail = :mail";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function CreatePostforAll($type,$titre, $contenu, $date, $lieu, $photo, $for, $mail, $link){
        // creer le post
        $sql = "INSERT INTO `post` (`type`, `titre`, `contenu`, `date`, `photo`, `for`, `link`) 
                VALUES (:type, :titre, :contenu, :date, :photo, :for, :link)";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':for', $for);
        $stmt->bindParam(':link', $link);
        $stmt->execute();
        //recuperer l'id du post creer
        $idpost = self::$database->lastInsertId();
        //recuperer l'id de l'utilisateur qui a creer le post
        $sql3 = "SELECT idadmin FROM admin WHERE mail = :mail";
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':mail', $mail);
        $stmt3->execute();
        $idadmin = $stmt3->fetchAll();
        $idadmin = $idadmin[0][0];
        echo("idadmin".$idadmin);
        //ajouter l'id du post et l'id de l'utilisateur dans la table post_has_user
        $sql4 = "INSERT INTO `post_has_admin` (`idpost`, `idadmin`) VALUES (:idpost, :iduser)";
        $stmt4 = self::$database->prepare($sql4);
        $stmt4->bindParam(':idpost', $idpost);
        $stmt4->bindParam(':iduser', $idadmin);
        $stmt4->execute();
        //ajouter le lieu
        $this->Makelieu($lieu, $idpost);
        return true;
    }


    // post fonction user

    public function ShowPost(){
        $sql = "SELECT * FROM post ORDER BY date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function createAdmin($nom,$mail, $password){
        $sql = "INSERT INTO `admin` (`nameAdmin`, `mail`, `password`) VALUES (:nom, :mail, :password)";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return true;
    }
    //fonction pour gerer les lieux dans le alterpost
    public function Makelieu($lieu, $idpost){
        // Mettre à jour le lieu associé au post
        $sql1 = 'SELECT idlieu FROM lieu WHERE nom = :nom';
        $stmt1 = self::$database->prepare($sql1);
        $stmt1->bindParam(':nom', $lieu);
        $stmt1->execute();
        $result = $stmt1->fetch();
        if (!$result) {
            // Le lieu n'existe pas encore dans la base de données, on l'ajoute
            $sql2 = 'INSERT INTO lieu (nom) VALUES (:nom)';
            $stmt2 = self::$database->prepare($sql2);
            $stmt2->bindParam(':nom', $lieu);
            $stmt2->execute();
            $idlieu = self::$database->lastInsertId();
        } else {
            // Le lieu existe déjà dans la base de données, on récupère son ID
            $idlieu = $result['idlieu'];
        }

        // Mettre à jour la relation entre le post et le lieu
        $sql3 = 'INSERT INTO post_has_lieu (idpost, idlieu) VALUES (:idpost, :idlieu) ON DUPLICATE KEY UPDATE idlieu = :idlieu';
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':idpost', $idpost);
        $stmt3->bindParam(':idlieu', $idlieu);
        $stmt3->execute();
        return true;
    }
    public function AlterAllPost($idpost, $titre, $contenu, $date, $photo, $interets, $for, $link,$lieu){
        if($photo == NULL){
            $sql = "UPDATE post SET titre = :titre, contenu = :contenu, date = :date, for = :for, link = :link, interets = :interets WHERE idpost = :idpost";
            $stmt = self::$database->prepare($sql);

            $stmt->bindParam(':date', $date);
        }else{
            $sql = "UPDATE post SET titre = :titre, contenu = :contenu, date = :date, photo = :photo, for = :for, link = :link, interets = :interets WHERE idpost = :idpost";
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':photo', $photo);
        }
        $stmt->bindParam(':idpost', $idpost);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':for', $for);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':interets', $interets);
        $stmt->execute();
        $this->Makelieu($lieu, $idpost);
        return true;
    }
    public function DeletePost($idpost){
        $sql1= "DELETE FROM post_user WHERE idpost = :idpost";
        $stmt1 = self::$database->prepare($sql1);
        $stmt1->bindParam(':idpost', $idpost);
        $stmt1->execute();
        $sql2 = "DELETE FROM post_has_admin WHERE idpost = :idpost";
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

    //admin stat
    public function ShowMaxUser(){
        $sql = "SELECT COUNT(iduser) FROM user";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        $var =  $stmt->fetchAll();
        return $var[0][0];
    }
    public function StatLikeByPost(){
        $sql = "SELECT COUNT(*) AS like_count, post.titre as post_title
                FROM likes
                JOIN post ON likes.idpost = post.idpost
                WHERE likes.type = 'like'
                GROUP BY post.idpost
                ORDER BY like_count DESC
                LIMIT 5";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function StatUserFriend(){
        $sql = "SELECT user.mail, COUNT(user_has_amis.iduser) as num_friends 
                FROM user
                JOIN user_has_amis ON user_has_amis.idamis = user.iduser
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

    public function StatForMessagePerDay(){
        $sql = "SELECT COUNT(*) AS message_count, DATE_FORMAT(date, '%d/%m/%Y') AS date
        FROM message
        WHERE date >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        GROUP BY DATE_FORMAT(date, '%d/%m/%Y')
        ORDER BY date DESC
        LIMIT 7";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    //Gestion des AMITIÉs

    public function defaultFriend($mail){
        $sql1 = "SELECT iduser FROM user WHERE mail = :mail";
        $stmt1 = self::$database->prepare($sql1);
        $stmt1->bindParam(':mail', $mail);
        $stmt1->execute();
        $iduser = $stmt1->fetchColumn();

        $sql2 ="SELECT idpromos FROM user_has_promos WHERE iduser = :id";
        $stmt2 = self::$database->prepare($sql2);
        $stmt2->bindParam(':id', $iduser);
        $stmt2->execute();
        $idpromo = $stmt2->fetchColumn();
    
        $sql3 = "SELECT iduser FROM user_has_promos WHERE idpromos = :promo";
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':promo', $idpromo);
        $stmt3->execute();
    
        while ($idami = $stmt3->fetchColumn()) {
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
        $sql="SELECT iduser FROM user_has_amis WHERE idamis = :id AND statut = 2";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $idDemandes = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        $friendRequests = [];
        foreach ($idDemandes as $idDemande) {
            $sql="SELECT * FROM user WHERE iduser = :id";
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':id', $idDemande);
            $stmt->execute();
            $friendRequests[] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        return $friendRequests;
    }

    public function acceptFriendRequest($requester_id, $user_id) {
        $sql = 'UPDATE user_has_amis
                                SET statut = 1
                                WHERE iduser = :requester_id AND idamis = :user_id AND statut = 2';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':requester_id', $user_id);
        $stmt->bindParam(':user_id', $requester_id);
        $stmt->execute();
    }

    public function rejectFriendRequest($requester_id, $user_id) {
        $sql = 'DELETE FROM user_has_amis
                                WHERE iduser = :requester_id AND idamis = :user_id AND statut = 2';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':requester_id', $user_id);
        $stmt->bindParam(':user_id', $requester_id);
        $stmt->execute();
    }
    public function ShowFriends($id) {
        $sql = 'SELECT iduser FROM user_has_amis WHERE idamis = :id AND statut = 1';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $idAmis = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        if (!$idAmis) {
            $sql = 'SELECT idamis FROM user_has_amis WHERE iduser = :id AND statut = 1';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $idAmis = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
    
        $friends = [];
        foreach ($idAmis as $idAmi) {
            $sql = 'SELECT * FROM user WHERE iduser = :id';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':id', $idAmi);
            $stmt->execute();
            $friends[] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        return $friends;
    }
    
    
    

  //Message

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


    //create contenu + identification lieu et personne
    public function CreatePost($type,$titre, $contenu, $date,$lieu, $photo, $iduser,$etiquette){

        $sql5 = 'SELECT iduser FROM user WHERE nom = :nom';
        $stmt = self::$database->prepare($sql5);
        $stmt->bindParam(':nom', $etiquette);
        $stmt->execute();
        $idamis=$stmt->fetch(); 

        $sql5 = 'SELECT idamis FROM user_has_amis WHERE (iduser= :iduser AND idamis= :idamis) OR (iduser= :idamis AND idamis= :iduser) AND statut=1';
        $stmt = self::$database->prepare($sql5);
        $stmt->bindParam(':iduser', $iduser);
         $stmt->bindParam(':idamis', $idamis['iduser']);
        $stmt->execute();
        $result=$stmt->fetch();

        if (!$result){
            return false;
         } else {
             $idAmis= $idamis['iduser'];
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

    public function CreatePostActualite($type,$titre, $contenu, $date,$lieu, $photo, $iduser,$etiquette,$link){

        $sql5 = 'SELECT iduser FROM user WHERE nom = :nom';
        $stmt = self::$database->prepare($sql5);
        $stmt->bindParam(':nom', $etiquette);
        $stmt->execute();
        $idamis=$stmt->fetch(); 

        $sql5 = 'SELECT idamis FROM user_has_amis WHERE (iduser= :iduser AND idamis= :idamis) OR (iduser= :idamis AND idamis= :iduser) AND statut=1';
        $stmt = self::$database->prepare($sql5);
        $stmt->bindParam(':iduser', $iduser);
         $stmt->bindParam(':idamis', $idamis['iduser']);
        $stmt->execute();
        $result=$stmt->fetch();

        if (!$result){
            return false;
         } else {
             $idAmis= $idamis['iduser'];
         }

        $sql = "INSERT INTO post (type, titre, contenu, date, photo,etiquette,link) 
                VALUES (:type, :titre, :contenu, :date, :photo,:etiquette,:link)";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':etiquette', $idAmis);
        $stmt->bindParam(':link', $link);
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


    public function getUserByUsername($username) {
    $sql = 'SELECT iduser, username FROM user WHERE username = :username';
    $stmt = self::$database->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch();
}

    public function getLieuByNom($nom) {
        $sql = 'SELECT idlieu, nom FROM lieu WHERE nom = :nom';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getLieuByIdPost($idpost) {
        $sql = 'SELECT lieu.idlieu, lieu.nom as lieu_nom 
                FROM lieu 
                    INNER JOIN post_has_lieu ON lieu.idlieu = post_has_lieu.idlieu 
                WHERE post_has_lieu.idpost = :idpost';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->execute();
        return $stmt->fetch();
    }




    //Voir ses postes

    public function ShowPostALL(){
        $sql = "SELECT post.*, user.iduser, user.nom AS user_nom, user.prenom, lieu.idlieu, lieu.nom AS lieu_nom
                FROM post
                INNER JOIN user ON post.etiquette = user.iduser
                INNER JOIN post_has_lieu ON post.idpost = post_has_lieu.idpost
                INNER JOIN lieu ON post_has_lieu.idlieu = lieu.idlieu
                ORDER BY post.date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function showPostUser($id){
        $sql = "SELECT DISTINCT post.*, user.iduser, user.nom AS user_nom, user.prenom, etiquette_user.nom AS etiquette_nom, etiquette_user.prenom AS etiquette_prenom, lieu.idlieu, lieu.nom AS lieu_nom
        FROM post
        INNER JOIN post_has_lieu ON post.idpost = post_has_lieu.idpost
        INNER JOIN lieu ON post_has_lieu.idlieu = lieu.idlieu
        INNER JOIN post_user ON post.idpost = post_user.idpost
        INNER JOIN user ON post_user.iduser = user.iduser
        INNER JOIN user_has_amis ON user.iduser = user_has_amis.idamis OR user.iduser = user_has_amis.iduser
        LEFT JOIN user AS etiquette_user ON post.etiquette = etiquette_user.iduser
                WHERE post_user.iduser = :iduser
                ORDER BY post.date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':iduser', $id);
        $stmt->execute();
       
    
        $posts = $stmt->fetchAll();

         // Récupérer le nombre de likes pour chaque publication
         foreach ($posts as $key=>$post) {
            $sql_likes = "SELECT COUNT(*) FROM likes WHERE idpost = :idpost";
            $stmt_likes = self::$database->prepare($sql_likes);
            $stmt_likes->bindParam(':idpost', $post['idpost']);
            
            $stmt_likes->execute();
          
            
            $posts[$key]['nb_likes'] = $stmt_likes->fetchColumn();
        }
        
        return $posts;
    }

    public function ShowPostAmi($iduser){
        $sql = "SELECT DISTINCT post.*, user.iduser, user.nom AS user_nom, user.prenom, etiquette_user.nom 
        AS etiquette_nom, etiquette_user.prenom AS etiquette_prenom, lieu.idlieu, lieu.nom AS lieu_nom
                FROM post
                INNER JOIN post_has_lieu ON post.idpost = post_has_lieu.idpost
                INNER JOIN lieu ON post_has_lieu.idlieu = lieu.idlieu
                INNER JOIN post_user ON post.idpost = post_user.idpost
                INNER JOIN user ON post_user.iduser = user.iduser
                INNER JOIN user_has_amis ON user.iduser = user_has_amis.idamis OR user.iduser = user_has_amis.iduser
                LEFT JOIN user AS etiquette_user ON post.etiquette = etiquette_user.iduser
                WHERE (user_has_amis.iduser = :iduser OR user_has_amis.idamis = :iduser) AND user_has_amis.statut = 1 AND post.type = 3
                ORDER BY post.date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':iduser', $iduser);
        $stmt->execute();
        $posts = $stmt->fetchAll();
    
        // Récupérer le nombre de likes pour chaque publication
        foreach ($posts as $key=>$post) {
            $sql_likes = "SELECT COUNT(*) FROM likes WHERE idpost = :idpost";
            $stmt_likes = self::$database->prepare($sql_likes);
            $stmt_likes->bindParam(':idpost', $post['idpost']);
            
            $stmt_likes->execute();
          
            
            $posts[$key]['nb_likes'] = $stmt_likes->fetchColumn();
        }
        
        return $posts;
      
    }


    public function ShowPostEvenement(){
        $sql = "SELECT DISTINCT post.*, user.iduser, user.nom AS user_nom, user.prenom, etiquette_user.nom 
        AS etiquette_nom, etiquette_user.prenom AS etiquette_prenom, lieu.idlieu, lieu.nom AS lieu_nom
                FROM post
                INNER JOIN post_has_lieu ON post.idpost = post_has_lieu.idpost
                INNER JOIN lieu ON post_has_lieu.idlieu = lieu.idlieu
                INNER JOIN post_user ON post.idpost = post_user.idpost
                INNER JOIN user ON post_user.iduser = user.iduser
                LEFT JOIN user AS etiquette_user ON post.etiquette = etiquette_user.iduser
                WHERE post.type = 2
                ORDER BY post.date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        $posts = $stmt->fetchAll();
    
        // Récupérer le nombre de likes pour chaque publication
        foreach ($posts as $key=>$post) {
            $sql_likes = "SELECT COUNT(*) FROM likes WHERE idpost = :idpost";
            $stmt_likes = self::$database->prepare($sql_likes);
            $stmt_likes->bindParam(':idpost', $post['idpost']);
            
            $stmt_likes->execute();
          
            
            $posts[$key]['nb_likes'] = $stmt_likes->fetchColumn();
        }
        
        return $posts;
      
    }

    public function ShowPostActualite(){
        $sql = "SELECT DISTINCT post.*, user.iduser, user.nom AS user_nom, user.prenom, etiquette_user.nom 
        AS etiquette_nom, etiquette_user.prenom AS etiquette_prenom, lieu.idlieu, lieu.nom AS lieu_nom
                FROM post
                INNER JOIN post_has_lieu ON post.idpost = post_has_lieu.idpost
                INNER JOIN lieu ON post_has_lieu.idlieu = lieu.idlieu
                INNER JOIN post_user ON post.idpost = post_user.idpost
                INNER JOIN user ON post_user.iduser = user.iduser
                LEFT JOIN user AS etiquette_user ON post.etiquette = etiquette_user.iduser
                WHERE post.type = 1
                ORDER BY post.date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        $posts = $stmt->fetchAll();
    
        // Récupérer le nombre de likes pour chaque publication
        foreach ($posts as $key=>$post) {
            $sql_likes = "SELECT COUNT(*) FROM likes WHERE idpost = :idpost";
            $stmt_likes = self::$database->prepare($sql_likes);
            $stmt_likes->bindParam(':idpost', $post['idpost']);
            
            $stmt_likes->execute();
          
            
            $posts[$key]['nb_likes'] = $stmt_likes->fetchColumn();
        }
        
        return $posts;
      
    }

    public function getLastEvent(){
        $sql = "SELECT * FROM post WHERE post.type = 2 ORDER BY post.date DESC LIMIT 1";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getLastActualite(){
        $sql = "SELECT * FROM post WHERE post.type = 1 ORDER BY post.date DESC LIMIT 1";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getNomByLieu($id) {
        $sql = "SELECT * FROM lieu WHERE idlieu = :id";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function ShowPostByLieu($id_lieu){
        $sql = "SELECT post.*, user.iduser, user.nom AS user_nom, user.prenom, etiquette_user.nom AS etiquette_nom, etiquette_user.prenom AS etiquette_prenom, lieu.idlieu, lieu.nom AS lieu_nom
        FROM post
        INNER JOIN post_user ON post.idpost = post_user.idpost
        INNER JOIN user ON post_user.iduser = user.iduser
        INNER JOIN post_has_lieu ON post.idpost = post_has_lieu.idpost
        INNER JOIN lieu ON post_has_lieu.idlieu = lieu.idlieu
        INNER JOIN user AS etiquette_user ON post.etiquette = etiquette_user.iduser
        WHERE lieu.idlieu = :id_lieu
        ORDER BY post.date DESC
        ";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':id_lieu', $id_lieu);
        $stmt->execute();
        $posts = $stmt->fetchAll();
         // Récupérer le nombre de likes pour chaque publication
         foreach ($posts as $key=>$post) {
            $sql_likes = "SELECT COUNT(*) FROM likes WHERE idpost = :idpost";
            $stmt_likes = self::$database->prepare($sql_likes);
            $stmt_likes->bindParam(':idpost', $post['idpost']);
            
            $stmt_likes->execute();
          
            
            $posts[$key]['nb_likes'] = $stmt_likes->fetchColumn();
        }
        
        return $posts;
        
    }

    //like
    public function likes($idpost, $mail, $like_type) {

        // Vérifier si l'utilisateur a déjà aimé le post
        $sql3 = 'SELECT * FROM likes WHERE idpost = :idpost AND iduser = :iduser';
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':idpost', $idpost);
        $stmt3->bindParam(':iduser', $mail);
        $stmt3->execute();
        $result = $stmt3->fetch(PDO::FETCH_ASSOC);
    
        if ($result !== false) {
            // L'utilisateur a déjà aimé le post, on met à jour le like
            $sql = 'UPDATE likes SET type = :like_type WHERE idpost = :idpost AND iduser = :iduser';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':idpost', $idpost);
            $stmt->bindParam(':iduser', $mail);
            $stmt->bindParam(':like_type', $like_type);
            $stmt->execute();
        } else {
            // L'utilisateur n'a pas encore aimé le post, on insère un nouveau like
            $sql = 'INSERT INTO likes (type, idpost, iduser)
                    VALUES (:like_type, :idpost, :iduser)';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':like_type', $like_type);
            $stmt->bindParam(':idpost', $idpost);
            $stmt->bindParam(':iduser', $mail);
            $stmt->execute();
        }
    
        return true;
    }

    
    
    
    //show Post ami

    public function listerNonAmis($userId){
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
    
    //Pour les users recherche mais pas utilise RECHERCHE SUR TT LES UTILISATEURS
    
    public function rechercherUtilisateur($utilisateur)
    {
        $reg = self::$database->prepare("SELECT * FROM user WHERE nom LIKE ? LIMIT 10");
        $reg->execute(array("%$utilisateur%"));
        return $reg->fetchAll();
    }



    public function CountLike($idpost){
        $sql = 'SELECT COUNT(*) AS nblike FROM likes WHERE idpost = :idpost AND `like` = 1';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result !== false && isset($result['nblike'])) {
            return $result['nblike'];
        } else {
            return 0;
        }
    }
    public function hasLikedPost($idpost, $email)
    {
        $stmt =self::$database->prepare("SELECT COUNT(*) FROM likes WHERE idpost = ? AND iduser = ?");
        $stmt->execute([$idpost, $email]);
        return $stmt->fetchColumn() > 0;
    }
        //MARCHE 
        public function rechercherNonAmis($utilisateur, $userId)
        {
            // Recherche des utilisateurs avec le nom similaire
            $reg = self::$database->prepare("SELECT * FROM user WHERE nom LIKE ? AND iduser!=? LIMIT 10");
            $reg->execute(array("%$utilisateur%",$userId));
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
    
   //MODIFIER LES POST USER
    function getPostById($idpost) {
        $sql = "SELECT * FROM post WHERE idpost = :idpost";
        $statement = self::$database->prepare($sql);
        $statement->bindParam(':idpost', $idpost, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function alterPost($idpost, $type, $titre, $contenu, $date, $lieu, $photo, $iduser, $etiquette) {
        // Vérifier si l'utilisateur a le droit de modifier le post
        var_dump($idpost, $type, $titre, $contenu, $date, $lieu, $photo, $iduser, $etiquette);
        $sql = 'SELECT iduser FROM post_user WHERE idpost = :idpost';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->execute();
        $result = $stmt->fetch();
        $iduser = $_SESSION['iduser'];
        if (!$result || $result['iduser'] != $iduser) {
            return "L'utilisateur n'a pas le droit de modifier ce post.";
        }
    
        // Récupérer idamis à partir de l'étiquette
        $sql5 = 'SELECT iduser FROM user WHERE nom = :nom';
        $stmt = self::$database->prepare($sql5);
        $stmt->bindParam(':nom', $etiquette);
        $stmt->execute();
        $idamis = $stmt->fetch();
        if (!$idamis) {
            return "L'étiquette n'a pas été trouvée.";
        }
    
        // Vérifier si l'utilisateur et l'ami sont amis
        $sql5 = 'SELECT idamis FROM user_has_amis WHERE (iduser= :iduser AND idamis= :idamis) OR (iduser= :idamis AND idamis= :iduser) AND statut=1';
        $stmt = self::$database->prepare($sql5);
        $stmt->bindParam(':iduser', $iduser);
        $stmt->bindParam(':idamis', $idamis['iduser']);
        $stmt->execute();
        $result = $stmt->fetch();
    
        if (!$result) {
            return "L'utilisateur et l'ami ne sont pas amis.";
        } else {
            $idAmis = $idamis['iduser'];
        }
    
        // Mettre à jour les informations du post
        $sql = 'UPDATE post SET type = :type, titre = :titre, contenu = :contenu, date = :date, photo = :photo, etiquette = :etiquette WHERE idpost = :idpost';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':etiquette', $idAmis);
        if (!$stmt->execute()) {

            return "Échec de la mise à jour du post.";
        }
    
        // Mettre à jour le lieu associé au post
        if (!empty($lieu)) {
        $sql = 'SELECT idlieu FROM lieu WHERE nom = :nom';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':nom', $lieu);
        $stmt->execute();
        $result = $stmt->fetch();
        if (!$result) {
            // Le lieu n'existe pas encore dans la base de données, on l'ajoute
            $sql = 'INSERT INTO lieu (nom) VALUES (:nom)';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':nom', $lieu);
            if (!$stmt->execute()) {
            return "Échec de l'ajout du lieu.";
            }
            $idlieu = self::$database->lastInsertId();
            } else {
            // Le lieu existe déjà dans la base de données, on récupère son ID
            $idlieu = $result['idlieu'];
            }// Mettre à jour la relation entre le post et le lieu
            $sql = 'INSERT INTO post_has_lieu (idpost, idlieu) VALUES (:idpost, :idlieu) ON DUPLICATE KEY UPDATE idlieu = :idlieu';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':idpost', $idpost);
            $stmt->bindParam(':idlieu', $idlieu);
            if (!$stmt->execute()) {
            return "Échec de la mise à jour de la relation entre le post et le lieu.";
            }
        }
            // Supprimer les anciennes relations entre le post et les autres lieux
            $sql = 'DELETE FROM post_has_lieu WHERE idpost = :idpost AND idlieu != :idlieu';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':idpost', $idpost);
            $stmt->bindParam(':idlieu', $idlieu);
            if (!$stmt->execute()) {
                return "Échec de la suppression des anciennes relations entre le post et les autres lieux.";
            }

            return "success";
                }
    

    public function alterPost3($idpost, $type, $titre, $contenu, $date, $lieu, $photo, $iduser, $etiquette){
        // Vérifier si l'utilisateur a le droit de modifier le post
        $sql = 'SELECT iduser FROM post_user WHERE idpost = :idpost';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->execute();
        $result = $stmt->fetch();
        $iduser=$_SESSION['iduser'];
        if (!$result || $result['iduser'] != $iduser) {
            return false;
       
        }
   
        // Mettre à jour les informations du post
        $sql = 'UPDATE post SET `type` = :type, titre = :titre, contenu = :contenu, `date` = :date, photo = :photo, etiquette = :etiquette WHERE idpost = :idpost';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':etiquette', $etiquette);
        $stmt->execute();
        //var_dump($stmt->errorInfo());
    
        // Mettre à jour le lieu associé au post
        $sql = 'SELECT idlieu FROM lieu WHERE nom = :nom';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':nom', $lieu);
        $stmt->execute();
        $result = $stmt->fetch();
        if (!$result) {
            // Le lieu n'existe pas encore dans la base de données, on l'ajoute
            $sql = 'INSERT INTO `lieu` (`nom`) VALUES (:nom)';
            $stmt = self::$database->prepare($sql);
            $stmt->bindParam(':nom', $lieu);
            $stmt->execute();
            $idlieu = self::$database->lastInsertId();
        } else {
            // Le lieu existe déjà dans la base de données, on récupère son ID
            $idlieu = $result['idlieu'];
        }
    
        // Mettre à jour la relation entre le post et le lieu
        $sql = 'UPDATE `post_has_lieu` SET `idlieu` = :idlieu WHERE `idpost` = :idpost';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->bindParam(':idlieu', $idlieu);
        $stmt->execute();
    
        return true;
    }
    
    
    

    //reinitialisation mdp
    function checkEmailExists($email) {
        $sql = "SELECT * FROM user WHERE mail = :mail";
        $statement = self::$database->prepare($sql);
        $statement->bindParam(':mail', $email);
        $statement->execute();
        return $statement->fetch();
    }

    function updatePassword($email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password = :password WHERE mail = :mail";
        $statement = self::$database->prepare($sql);
        $statement->bindParam(':password', $hashedPassword);
        $statement->bindParam(':mail', $email);
        $statement->execute();
    }





    public function rechercherUtilisateursParIdentification($identification,$iduser) {
        $sql = "SELECT nom, prenom FROM user WHERE nom LIKE :identification AND iduser!= :id";
        $stmt = self::$database->prepare($sql);
        $stmt->bindValue(':identification', '%' . $identification . '%');
        $stmt->bindParam(':id', $iduser);
        $stmt->execute();
      
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      
      public function rechercherLieux($lieu) {
        $sql = "SELECT nom as lieu FROM lieu WHERE nom LIKE :lieu";
        $stmt = self::$database->prepare($sql);
        $stmt->bindValue(':lieu', '%' . $lieu . '%');
        $stmt->execute();
      
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

    //notification

    public function getUserByNom($nom){
        $sql = 'SELECT * FROM user WHERE nom = :nom';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Pas utiliser
    public function getLastPostUserForNotif2($identifie){
        $sql = "SELECT * FROM post WHERE etiquette = :etiquette ORDER BY date DESC LIMIT 1";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':etiquette', $identifie);
        $stmt->execute();
        return $stmt->fetch();
    }


    public function getLastPostUserForNotif($identifie){
        $sql = "SELECT post.*, user.iduser, user.nom AS user_nom, user.prenom, etiquette_user.nom AS etiquette_nom, etiquette_user.prenom AS etiquette_prenom, lieu.idlieu, lieu.nom AS lieu_nom
        FROM post
        INNER JOIN post_user ON post.idpost = post_user.idpost
        INNER JOIN user ON post_user.iduser = user.iduser
        INNER JOIN post_has_lieu ON post.idpost = post_has_lieu.idpost
        INNER JOIN lieu ON post_has_lieu.idlieu = lieu.idlieu
        INNER JOIN user AS etiquette_user ON post.etiquette = etiquette_user.iduser
        WHERE post.etiquette = :etiquette
        ORDER BY post.date DESC
        ";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':etiquette', $identifie);
        $stmt->execute();
        $posts = $stmt->fetchAll();
         // Récupérer le nombre de likes pour chaque publication
         foreach ($posts as $key=>$post) {
            $sql_likes = "SELECT COUNT(*) FROM likes WHERE idpost = :idpost";
            $stmt_likes = self::$database->prepare($sql_likes);
            $stmt_likes->bindParam(':idpost', $post['idpost']);
            
            $stmt_likes->execute();
          
            
            $posts[$key]['nb_likes'] = $stmt_likes->fetchColumn();
        }
        
        return $posts;
        
    }

    
}
    








