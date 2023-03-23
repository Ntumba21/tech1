<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../../view/style/style.css">
    
</head>
<body>
<header>
    <img src="../../media/logo ECEBOOK.png" alt="Logo" class="logo"> 
    <h1>Inscription</h1>
</header>
<div class="content">
    <div class="square">
</head>

<body>
       
        <form action="../controllers/registercontroller.php" method="post">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" required>
            </div>
            <div class="form-group">
                <label for="mail">E-mail :</label>
                <input type="email" name="mail" id="mail" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="date_de_naissance">Date de naissance :</label>
                <input type="date" name="date_de_naissance" id="date_de_naissance" required>
            </div>
            <div class="form-group">
                <label for="type">Type :</label>
                <select name="type" id="type" required>
                    <option value="1">Étudiant</option>
                    <option value="2">Enseignant</option>
                    <option value="3">Administrateur</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville" required>
            </div>
            <div class="form-group">
                <label for="interests">Intérêts :</label>
                <input type="text" name="interests" id="interests">
            </div>
            <div class="form-group">
                <label for="photo">Photo :</label>
                <input type="file" name="photo" id="photo">
            </div>
            <div class="form-group">
                <label for="idpromos">Promos :</label>
                <select name="idpromos" id="idpromos" required>
                    <!-- Ajoutez les options pour les différentes promotions ici -->
                    <option value="1">Promo 1</option>
                    <option value="2">Promo 2</option>
                </select>
            </div>
            <button type="submit">Créer un compte</button>
        </form>
    </div>
    </div>
</div>
</body>
<footer>
<a href="#">Tous droits reservés Wilfried,Ashley,Manal,Emmany,Naomy,Sofian </a>
</footer>
</body>
</html>

