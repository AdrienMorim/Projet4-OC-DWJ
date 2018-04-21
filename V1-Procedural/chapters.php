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
        <h2>Listes des chapitres</h2>
        <p>
            <a href="index.php">Retour à la page d'Accueil</a>
        </p>

        <?php
        //Connexion DataBase
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=Projet4;charset=utf8', 'root', 'root');
        }
        catch (Exception $e)
        {
            die('Erreur : ' .$e->getMessage());
        }

        //Récuperation des données pour la pagination
        $chapter_per_page = 3;
        $req = $db->query('SELECT COUNT(id) AS chapters_total FROM chapters');
        $chapters_number = $req->fetch();
        $chapters_total = $chapters_number['chapters_total'];
        $pages_number = ceil($chapters_total/$chapter_per_page);

        if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pages_number){
            $_GET['page'] = intval($_GET['page']);
            $current_page = $_GET['page'];
        }else{
            $current_page = 1;
        }

        $first_page = ($current_page-1)* $chapter_per_page;
        $req->closeCursor();

        //On recupère les 3 derniers chapitres
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT ?, ?');
        $req->bindParam(1,$first_page, PDO::PARAM_INT);
        $req->bindParam(2,$chapter_per_page, PDO::PARAM_INT);
        $req->execute();

        while ($data = $req->fetch())
        {
            ?>
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
            <?php
        } // fin de la boucle des chapitres
        $req->closeCursor();
        ?>

        <!-- Pagination avec 1ère méthode -->
        <?php
        echo '<div class=pagination> Pages : ';
        for($i = 1 ; $i <= $pages_number ; $i++){
            if ($i == $current_page){
                echo '<span> ' . $i . ' </span>'; // affiche la page courante sans lien
            } else{
                echo '<a href="chapters.php?page=' . $i . '">' . $i . '</a>';
            }
        }
        echo '</div>'
        ?>
    </body>
</html>