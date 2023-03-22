<?php require_once '../controller/promo.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/register.css">
<style>
    .logo {
  max-width: 100%;
  max-height: 100%;
  margin: 1rem;
}

.register-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: calc(100vh - 100px);
}

.register-container form {
  border: 1px solid black;
  border-radius: 0;
  padding: 2rem;
}


form {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 100%;
  max-width: 500px;
}

.form-group {
  margin-bottom: 1rem;
  width: 100%;
}

label {
  display: block;
  margin-bottom: 0.5rem;
}

input,
select,
textarea {
  padding: 0.5rem;
  font-size: 1rem;
  border: none;
  border-radius: 4px;
  background-color: #f4f4f4;
  width: 100%;
}

button[type="submit"] {
  margin-top: 1rem;
  padding: 0.5rem 1rem;
  font-size: 1rem;
  border: none;
  border-radius: 4px;
  background-color: black;
  color: white;
}

    </style> 
</head>
<img src="../media/logo ECEBOOK.png" alt="Logo" class="logo">
<body>
    <div class="register-container">
        <h1>Inscription</h1>
        <form action="../controller/register.php" method="post">
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
                    <?php ShowPromo(); ?>
                </select>
            </div>
            <button type="submit">Créer un compte</button>
        </form>
    </div>
</body>
</html>

