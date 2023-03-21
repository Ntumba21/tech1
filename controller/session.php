<?php
session_start();
function Session ($mail="", $iduser="",$connect = false){

    $_SESSION["mail"] = $mail;
    $_SESSION["iduser"] = $iduser;
    }
function VerifySession(){
        $session = false;
    
        if ($_SESSION["session"]){
            $session = true;
        }else{
            $session = false;
        }
        return $session;
    }

// function isUserConnected()
// {
//     return isset($_SESSION['iduser']) && !empty($_SESSION['iduser']);
// }

function isAdminConnected()
{
    return VerifySession() && $_SESSION['type'] == 3;
}

function redirectToHome()
{
    if (VerifySession()) {
        if ($_SESSION['type'] == 1 || $_SESSION['type'] == 2) {
            header('Location: home.php');
        } else {
            header('Location: adminhome.php');
        }
        exit();
    }
}

function redirectToLogin()
{
    if (!VerifySession()) {
        header('Location: login.php');
        exit();
    }
}

?>