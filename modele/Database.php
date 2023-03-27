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
    public function getInactiveUser() {
        $sql = 'SELECT * FROM user WHERE isvalide = 0';
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public function ConnectAdmin($mail, $password){
        $sql = "SELECT * FROM admin WHERE mail = :mail AND password = :password";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt-> fetchAll();
    }
    public function CreatePostforAll($type,$titre, $contenu, $date, $lieu, $photo, $interets, $etiquette, $for, $link, $mail){
        // creer le post
        $sql = "INSERT INTO `post` (`type`, `titre`, `contenu`, `date`, `photo`, `for`, `link`, `interets`, `etiquette`) 
                VALUES (:type, :titre, :contenu, :date, :photo, :for, :link, :interets, :etiquette)";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':for', $for);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':interets', $interets);
        $stmt->bindParam(':etiquette', $etiquette);
        $stmt->execute();
        //recuperer l'id du post creer
        $idpost = self::$database->lastInsertId();
        echo("idpost".$idpost);
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

    public function ShowPost(){
        $sql = "SELECT * FROM post ORDER BY date DESC";
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

    public function StatForMessagePerDay(){
        $sql = "SELECT COUNT(*) AS message_count, DATE_FORMAT(date, '%d/%m/%Y') AS date
                FROM message
                GROUP BY DATE_FORMAT(date, '%d/%m/%Y')
                WHERE date >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                ORDER BY date DESC
                LIMIT 7;";
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


    //create contenu
    public function CreatePost($type,$titre, $contenu, $date,$lieu, $photo, $iduser,$etiquette){
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
        $sql = 'SELECT iduser FROM post_user WHERE idpost = :idpost';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->execute();
        $result = $stmt->fetch();
        $iduser = $_SESSION['iduser'];
        if (!$result || $result['iduser'] != $iduser) {
            return false;
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
        $stmt->bindParam(':etiquette', $etiquette);
        $stmt->execute();
    
        // Mettre à jour le lieu associé au post
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
            $stmt->execute();
            $idlieu = self::$database->lastInsertId();
        } else {
            // Le lieu existe déjà dans la base de données, on récupère son ID
            $idlieu = $result['idlieu'];
        }
    
        // Mettre à jour la relation entre le post et le lieu
        $sql = 'INSERT INTO post_has_lieu (idpost, idlieu) VALUES (:idpost, :idlieu) ON DUPLICATE KEY UPDATE idlieu = :idlieu';
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':idpost', $idpost);
        $stmt->bindParam(':idlieu', $idlieu);
        $stmt->execute();
    
        return true;
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

    

    
}
    








