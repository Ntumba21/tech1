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
        self::$port = 3306;
        self::$bdd = 'projet-tech';
        self::$dns =" mysql:host=localhost;dbname="+ self::$bdd +";port="+ self::$port; // À changer selon vos configurations
        self::$user = "root"; // À changer selon vos configurations
        self::$password = ""; // À changer selon vos configurations
        self::$database = new PDO(self::$dns, self::$user, self::$password);
    }

     public function createUser($nom, $prenom, $mail, $password, $date_de_naissance, $type, $description, $ville, $interests, $photo, $isvalide, $idpromos) {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql='INSERT INTO user (nom, prenom, mail, password, date_de_naissance, type, description, ville, interests, photo, isvalide, idpromos) VALUES (:nom, :prenom, :mail, :hashed_password, :date_de_naissance, :type, :description, :ville, :interests, :photo, :isvalide, :idpromos)';
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
    public function GetUserByMail($mail){
        $sql = 'SELECT * FROM user WHERE mail = :mail';
        $statement = self::$database->prepare($sql);
        $statement->bindParam(":mail", $mail, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function Connect($mail){
        $sql = "SELECT * FROM user WHERE mail = :mail";
        $stmt = self::$database->prepare($sql);
        $stmt->execute(['mail' => $mail]);
        return $stmt-> fetchAll();
    }
    public function GetPromos(){
        $sql = "SELECT * FROM promos";
        $stmt = self::$database->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Admin function
    public function DeleteUser($mail){
        $sql = "DELETE FROM user WHERE mail = :mail";
        $stmt = self::$database->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        return true;
    }
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


}