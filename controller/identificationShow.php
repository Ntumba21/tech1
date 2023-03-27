<?php

// Trouvez les identifications de lieu et de personne dans le contenu et remplacez-les par des liens appropriés
      $data = new Database();
      $pattern = '/@(\w+)/';
      $contenu = preg_replace_callback($pattern, function ($matches) use ($data) {
          $username_or_lieu = $matches[1];
          $user = $data->getUserByUsername($username_or_lieu);
          $lieu = $data->getLieuByNom($username_or_lieu);

          if ($user) {
              return '<a href="../facebookk/profileUnique.php?id=' . $user['iduser'] . '">' . $user['nom'] . '</a>';
          } elseif ($lieu) {
              return '<a href="../facebookk/lieuPost.php?id=' . $lieu['idlieu'] . '">' . $lieu['nom'] . '</a>';
          } else {
              return $matches[0];
          }
      }, $contenu);
    ?>