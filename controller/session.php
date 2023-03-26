<?php
session_start();

function Session($mail="", $iduser="", $connect=false) {
    $_SESSION["mail"] = $mail;
    $_SESSION["iduser"] = $iduser;
    if ($connect){
        $_SESSION["session"] = true;
    }else{
        $_SESSION["session"]= false;
        
    }

}

function VerifySession(): bool{
    if (isset($_SESSION["session"]) && $_SESSION["session"]){
        return true;
    } else {
        return false;
    }
   
}
function logout(){
    session_destroy();
}


function redirectToHome() {
    if (VerifySession()) {
        $redirectUrl = "../view/home.php"; // use an absolute path
        echo '<script>window.location.href = "'.$redirectUrl.'";</script>';
           
        exit();
    }
}
function redirectToHomeAdmin() {
    if (VerifySession()) {
        $redirectUrl = "../../view/admin/adminhome.php"; // use an absolute path
        echo '<script>window.location.href = "'.$redirectUrl.'";</script>';
           
        exit();
    }
}


?>