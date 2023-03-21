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
        self::$port = '3307';
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
    public function getUserById($id)
    {
        $sql = 'SELECT * FROM user WHERE iduser = :id';
        $statement = $this->database->prepare($sql);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getuserbymail($email)
    {  // 'SELECT * FROM tbmember where UserName = :email and `Password`= :password'
        $sql = 'SELECT userid, password  FROM user WHERE mail = :email';
        $statement = $this->database->prepare($sql);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }
  
}