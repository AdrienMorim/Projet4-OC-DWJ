<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="Roman 'Billet simple pour l'Alaska', nouveau Roman de Jean Forteroche"/>
        <meta name="keywords" content="Jean Forteroche, Blog, Roman, Billet simple pour l'Alaska"/>
        <meta name="author" content="Jean Forteroche">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        <link rel="icon" type="image/ico" sizes="500X500" href="images/ico/favicon.png" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link href="https://fonts.googleapis.com/css?family=Audiowide|Orbitron:400,500" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
        <title>Billet simple Pour l'Alaska</title>
    </head>

    <body>
        <h1>Billet simple pour l'Alaska</h1>

        <?php

        //Connexion DataBase
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=Projet4;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
            die('Erreur : ' .$e->getMessage());
        }
        ?>

        <form action="create_registration.php" method="post">
            <div class="col-md-offset-2 col-md-8">
                <div class="form-group row">
                    <h2 class="col-md-offset-5 col-md-4">Inscription</h2>
                </div>
                <div class="form-group row">
                    <label for="pseudo" class="col-md-3">Pseudo :</label>
                    <div class="col-md-9">
                        <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Php"
                               value="<?php if (isset($_COOKIE['pseudo'])) { echo htmlspecialchars($_COOKIE['pseudo']); }?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-3">Mot de Passe :</label>
                    <div class="col-md-9">
                        <input type="password" name="password" id="password" class="form-control" placeholder="MySQL4.4"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirm" class="col-md-3">Confirmation du Mot de Passe :</label>
                    <div class="col-md-9">
                        <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="MySQL4.4"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-3">E-mail :</label>
                    <div class="col-md-9">
                        <input type="email" name="email" id="email" class="form-control" placeholder="mysql@oc.com"/>
                    </div>
                </div>
                <button type="submit" name="inscription" class="btn btn-primary col-md-offset-5 col-md-2">Inscription</button>
            </div>
        </form>
    </body>
</html>