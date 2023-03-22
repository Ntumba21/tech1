<?php
session_start();

require_once('../modele/Database.php');

function create() {
    if (isset($_POST['create_post'])) {
        $type = $_POST['type'];
        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        $date = date("Y-m-d H:i:s");
        $lieu = $_POST['lieu'];
        $photo = $_POST['photo'];
        $for = $_POST['for'];
        
        $postModel = new Database();
        $postModel->CreatePost($type, $titre, $contenu, $date, $lieu, $photo, $for);
        header("Location: index.php?action=home");
    }
    
    require_once('views/post/create.php');
}

$postController = new Database();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

switch ($action) {
    case 'home':
        $postController->ShowPost();
        break;
    case 'myposts':
        if (isset($_SESSION['iduser'])) {
            $postController->ShowPostByUSer();
        } else {
            header("Location: index.php?action=home");
        }
        break;
    case 'create':
        if (isset($_SESSION['iduser'])) {
            create();
        } else {
            header("Location: index.php?action=home");
        }
        break;
    default:
        $postController->ShowPost();
        break;
}
?>
