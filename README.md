# Projet-Tech

## Description
## Installation
- Importer la base de donnée dans phpmyadmin (fichier sql.sql dans le dossier db)
- dans le fichier database.php, modifier les paramètres de connexion à la base de donnée le root, le password, le nom de la base de donnée et le port (3306 si vous êtes sur msql et 3307 si vous êtes sur mariadb), le numéro de port peut être différent selon votre configuration vous pouvez le voir dans http://localhost/
- dans phpmyadmin, importer le fichier sql.sql dans la base de donnée
- ensuite importer le fichier promo.sql et admin.sql
- les identifiants de l'admin sont : `admin@admin.fr` et son mot de passe est: `admin`
## Utilisation
- Pour se connecter en tant qu'admin, aller sur la page http://localhost/Projet-Tech/view/admin/
- Pour se connecter en tant qu'étudiant et professeur, aller sur la page http://localhost/Projet-Tech/view/loginform.php
- Pour créer un compte etudiant, aller sur la page http://localhost/Projet-Tech/view/register.php
- Pour créer un compte professeur, aller sur la page http://localhost/Projet-Tech/view/register-prof.php
## Recommandations
- Pour une meilleure expérience, utiliser un navigateur web récent (Chrome, Firefox, Edge, Opera, Safari)
- S'il y a une erreur du type `` Fatal error: Uncaught PDOException: SQLSTATE[HY000] [1049] Base 'projet-tech' inconnue in C:\wamp64\www\Projet-Tech\modele\Database.php on line 17``, allez a la ligne 17 du fichier Database.php et changer le port de connexion à la base de donnée (3306 si vous êtes sur msql et 3307 si vous êtes sur mariadb)
- Utiliser de vrais mails qui respectent le critère de connection pour la creation d'un account sinom vous ne pourrez pas vous connecter
