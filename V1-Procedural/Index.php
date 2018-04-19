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
        <h2>Nouveau Roman - Jean Forteroche</h2>

    <?php
    //Connexion DataBase
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf-8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' .$e->getMessage());
    }

    //On recupère les 5 derniers chapitres
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 0, 5');

    while ($data = $req->fetch())
    {?>
        <div class="news">
            <h3>
                <?= htmlspecialchars($data['title']); ?>
                <em>le <?= $data['creation_date_fr']; ?></em>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($data['content'])); ?> <br/>
                <em><a href="comments.php?chapter=<?= $data['id']; ?>">Commentaires</a></em>
            </p>
        </div>
    <?php} // fin de la boucle des chapitres
    $req->closeCursor();
    ?>
    </body>
</html>