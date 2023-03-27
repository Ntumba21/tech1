<!DOCTYPE html>
<html>
<head>
    <base href="/" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Accueil</title>
    <style>
        /* ... (styles existants) ... */
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-0 col-md-2 col-lg-3"></div>
            <div class="col-sm-12 col-md-8 col-lg-6" style="text-align: center">
                <div class="form-group">
                    <input class="form-control" type="text" id="search-user" value="" placeholder="Rechercher un ou plusieurs utilisateurs" autocomplete="off" />
                    <div class="search-result"></div>
                </div>
            </div>
            <div class="col-sm-0 col-md-2 col-lg-3"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Recherche d'utilisateurs
            $('#search-user').keyup(function () {
                var utilisateur = $(this).val();
                if (utilisateur != "") {
                    $.ajax({
                        type: 'GET',
                        url: 'Projet-Tech/controller/barreRecherche.php',
                        data: 'user=' + encodeURIComponent(utilisateur),
                        success: function (data) {
                            $('.search-result').html(data);
                            $('.search-result a').click(function (e) {
                                e.preventDefault();
                                var nomPrenom = $(this).text();
                                var amiId = $(this).data('ami-id');

                                // Ajoutez un ami lorsque l'utilisateur clique sur le nom d'un utilisateur dans la liste de recherche
                                $.ajax({
                                    type: 'GET',
                                    url: 'Projet-Tech/controller/barreRecherche.php',
                                    data: {
                                        action: 'ajouterAmi',
                                        ami_id: amiId,
                                    },
                                    success: function () {
                                        $('#search-user').val('');
                                        $('.search-result').html('');
                                    },
                            });
                        });
                    },
                });
            } else {
                $('.search-result').html('');
            }
        });
    });
</script>
</body>
</html>
