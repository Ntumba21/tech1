<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <base href="/" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Accueil</title>
    <style>
        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .result-search {
            margin-top: 20px;
            border-bottom: 2px solid #ccc;
            padding: 10px;
        }
        .result-search h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .search-result {
            position: absolute;
            width: 100%;
            background-color: #fff;
            z-index: 1;
            border: 1px solid #ced4da;
            border-top: none;
            overflow-y: auto;
            max-height: 200px;
        }
        .search-result a {
            display: block;
            padding: 10px;
            cursor: pointer;
        }
        .search-result a:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-0 col-md-2 col-lg-3"></div>
            <div class="col-sm-12 col-md-8 col-lg-6" style="text-align: center">
                <h1>Mon site à moi</h1>
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
        $(document).ready(function() {
            $('#search-user').keyup(function() {
                var utilisateur = $(this).val();
                if (utilisateur != "") {
                    $.ajax({
                        type: 'GET',
                        url: 'Projet-Tech/controller/barreRecherche.php',
                        data: 'user=' + encodeURIComponent(utilisateur),
                        success: function(data) {
                            $('.search-result').html(data);
                            $('.search-result a').click(function(e) {
                                e.preventDefault();
                                var nomPrenom = $(this).text();
                                $('#search-user').val(nomPrenom);
                                $('.search-result').html('');
                            });
                        }
                    });
                } else {
                    $('.search-result').html('');
                }
            });
        });
    </script>
</body>
</html>

