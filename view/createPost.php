<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            background-color: #F5F5F5;
            font-family: Arial, sans-serif;
        }

        #logo {
            width: 50px;
            height: 50px;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        #form-container {
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px grey;
            max-width: 600px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid grey;
            font-size: 16px;
        }

        button[type="submit"] {
            margin-top: 10px;
            padding: 10px;
            background-color: black;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
<img src="../media/logo ECEBOOK.png" alt="Logo" class="logo">
<form action="../controller/createPostController.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="action" value="create">
  <label for="type">Type :</label>
  <input type="text" name="type" id="type"><br>
  <label for="titre">Titre :</label>
  <input type="text" name="titre" id="titre"><br>
  <label for="contenu">Contenu :</label>
  <textarea name="contenu" id="contenu"></textarea><br>
  <label for="date">Date :</label>
  <input type="date" name="date" id="date"><br>
  <label for="lieu">Lieu :</label>
  <input type="text" name="lieu" id="lieu"><br>
  <label for="photo">Photo :</label>
  <input type="file" name="photo" id="photo"><br>
  <button type="submit">Publier</button>
</form>

