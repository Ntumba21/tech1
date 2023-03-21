<?php

namespace controller;

use Database;

require_once ('..\modele\Database.php');
require_once ('..\controller\tools.php');

class user{
    public $name;
    public $firstname;
    public $mail;
    public $type;
    public $photo;
    

    public function MakeUser($mail){
        $data=new database();
        $result = $data->getUserByEmail($mail);
        $this->name = $result[0]['nom'];
        $this->firstname = $result[0]['prenom'];
        $this->mail = $result[0]['mail'];
        $this->type = $result[0]['type'];
        $this->photo = $result[0]['photo'];
    }

    public function activateAccount($email, $token) {
            $data=new database();
            $affectedRows = $data->activateAccount($email, $token);
            if ($affectedRows == 0) {
                print_r("Aucun utilisateur n'a été trouvé avec cet e-mail et ce token.");
            }
            return $affectedRows > 0;
    }

    public function getName(){return $this->name;}
    public function getFirstname(){return $this->firstname;}
    public function getMail(){return $this->mail;}
    public function getType(){return $this->type;}
    public function getPhoto(){return $this->photo;}



}