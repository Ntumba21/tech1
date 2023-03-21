<?php
session_start();

function Session($mail="", $iduser="", $connect=false) {
    $_SESSION["mail"] = $mail;
    $_SESSION["iduser"] = $iduser;
    if ($connect){
        $_SESSION["session"] = true;
    }else{
        $_SESSION["session"]=false;
        
    }

}

function VerifySession() {
    $session = false;

    if ($_SESSION["session"]){
        $session = true;
    }else{
        $session = false;
    }
    return $session;
}


function redirectToHome() {
    if (VerifySession()) {
            header('Location: home.php');
        exit();
    }
}

function redirectToLogin() {
    if (!VerifySession()) {
        header('Location: login.php');
        exit();
    }
}
?>