<!DOCTYPE html>
<html>
<head>
	<title>Mes posts - EceBook</title>
</head>
<body>
	<h1>Mes posts - EceBook</h1>

	<?php foreach ($posts as $post) { ?>
	<div>
		<h3><?php echo $post['titre']; ?></h3>
		<p><?php echo $post['contenu']; ?></p>
		<p>Date de création : <?php echo $post['date']; ?></p>
		<p>Lieu : <?php echo $post['lieu']; ?></p>
		<?php if (!empty($post['photo'])) { ?>
			<img src="<?php echo $post['photo']; ?>" alt="Photo du post">
		<?php } ?>
		<p>Nombre de likes : <?php echo $post['nblike']; ?></p>
		<p>Nombre de dislikes : <?php echo $post['nbdislike']; ?></p>
	</div>
	<?php } ?>

	<p><a href="index.php?action=home">Accueil</a></p>

	<h2>Créer un nouveau post</h2>
	<form method="post" action="index.php?action=create_post">
		<label for="type">Type :</label>
		<select name="type" id="type">
			<option value="actualites">Actualités</option>
			<option value="evenements">Événements</option>
			<option value="general">Général</option>
		</select>
		<br>
		<label for="titre">Titre :</label>
		<input type="text" name="titre" id="titre" required>
		<br>
		<label for="contenu">Contenu :</label>
		<textarea name="contenu" id="contenu" required></textarea>
		<br>
		<label for="lieu">Lieu :</label>
		<input type="text" name="lieu" id="lieu">
		<br>
		<label for="photo">Photo :</label>
		<input type="text" name="photo" id="photo">
		<br>
		<input type="submit" value="Publier">
	</form>
</body>
</html>
