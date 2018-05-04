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
        <h2>Connexion</h2>

        <form action="log.php" method="POST">
            <p>
                <label for="pseudo">Pseudo
                    <input type="text" name="pseudo" id="pseudo" placeholder="Indiquez ici votre nom d'utilisateur" value=""/>
                </label>
            </p>
            <p>
                <label for="password">Mot de passe
                    <input type="password" name="password" id="password" placeholder="Indiquez ici votre mot de passe"/>
                </label>
            </p>
            <button>
                <input type="submit" value="Connexion"/>
            </button>
        </form>
    </body>
</html>