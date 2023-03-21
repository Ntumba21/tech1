<?php
class Model {
  private $db;
  
  function __construct() {
    try {
      $this->db = new PDO('mysql:host=' . 'localhost'. ';dbname='. 'projet-tech;' . 'port='. '3307', 'root', '');
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      die();
    }
  }

  function setUserInactive($user_id) {
    $sql='UPDATE user SET isvalide = 0, inactive_time = NOW() WHERE iduser = ?';
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array($user_id));
  }

  function setUserActive($user_id) {
    $sql='UPDATE user SET isvalide = 1, inactive_time = NULL WHERE iduser = ?';
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array($user_id));
  }

  function deleteUser($user_id) {
    $stmt = $this->db->prepare('DELETE FROM user WHERE iduser = ?');
    $stmt->execute(array($user_id));
  }

  function getUserByEmail($email) {
    $stmt = $this->db->prepare('SELECT * FROM user WHERE mail = ?');
    $stmt->execute(array($email));
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  
}
?>
