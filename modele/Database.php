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

     public function createUser($nom, $prenom, $mail, $password, $date_de_naissance, $type, $description, $ville, $interests, $photo, $isvalide, $idpromos) {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql='INSERT INTO user (nom, prenom, mail, password, date_de_naissance, type, description, ville, interests, photo, isvalide, idpromos) 
                  VALUES (:nom, :prenom, :mail, :hashed_password, :date_de_naissance, :type, :description, :ville, :interests, :photo, :isvalide, :idpromos)';
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
            $stmt->bindParam(':idpromos', $idpromos);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
            return false;
        }        
    }
    //je travail ici MANAL
    public function GetUsersByID($id){
        $sql = 'SELECT * FROM user WHERE iduser = :id';
        $statement = self::$database->prepare($sql);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function GetUser($mail){
        $sql = 'SELECT * FROM user WHERE mail = :mail';
        $statement = self::$database->prepare($sql);
        $statement->bindParam(":mail", $mail, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function Connect($mail, $password){
        $sql = "SELECT * FROM `user`
                WHERE mail = :mail
                AND password = :password";
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
    public function AlterInformation($mail,$nom, $prenom,$date_de_naissance,$description,$ville, $interests,$photo,$idpromo){
        $sql = "UPDATE user 
                SET nom = :nom, 
                    prenom = :prenom, 
                    date_de_naissance = :date_de_naissance, 
                    description = :description, 
                    ville = :ville, 
                    interests = :interests, 
                    photo = :photo, 
                    idpromos = :idpromo 
                WHERE mail = :mail";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':date_de_naissance', $date_de_naissance);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':interests', $interests);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':idpromo', $idpromo);
        $stmt->execute();
        return true;
    }
    public function DeleteUser($mail){
        $sql = "DELETE FROM user WHERE mail = :mail";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        return true;
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
    public function CreatePostforAll($type,$titre, $contenu, $date, $lieu, $photo){
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
        $sql3 = "INSERT INTO post_admin (idpost, idAdmin) VALUES (:idpost, :idadmin)";
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':idpost', $idpost[0]);
        $stmt3->bindParam(':idadmin', $_SESSION['idadmin']);
        $stmt3->execute();
        return true;
    }
    public function CreatePostforProff($type,$titre, $contenu, $date, $lieu, $photo){
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
        $sql3 = "INSERT INTO post_admin (idpost, idAdmin) VALUES (:idpost, :idadmin)";
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':idpost', $idpost[0]);
        $stmt3->bindParam(':idadmin', $_SESSION['idadmin']);
        $stmt3->execute();
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
        $sql3 = "INSERT INTO post_admin (idpost, idAdmin) VALUES (:idpost, :idadmin)";
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':idpost', $idpost[0]);
        $stmt3->bindParam(':idadmin', $_SESSION['idadmin']);
        $stmt3->execute();
        return true;
    }
    public function ShowPostAdmin(){
        $sql = "SELECT * FROM post 
                inner join post_admin on post.idpost = post_admin.idpost 
                WHERE idadmin = :idadmin 
                ORDER BY date DESC";
    }
    // post fonction
    public function CreatePost($type,$titre, $contenu, $date, $lieu, $photo, $for){
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
        $sql3 = "INSERT INTO post_user (idpost, iduser) VALUES (:idpost, :iduser)";
        $stmt3 = self::$database->prepare($sql3);
        $stmt3->bindParam(':idpost', $idpost[0]);
        $stmt3->bindParam(':iduser', $_SESSION['iduser']);
        $stmt3->execute();
        return true;
    }
    public function ShowPost(){
        $sql = "SELECT * FROM post ORDER BY date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function ShowPostByUSer(){
        $sql = "SELECT * FROM post 
                inner join post_user on post.idpost = post_user.idpost 
                WHERE iduser = :iduser ORDER BY date DESC";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':iduser', $_SESSION['iduser']);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}