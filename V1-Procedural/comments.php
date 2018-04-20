<?php
// On démarre la session avant d'écrire du HTML
session_start();
?>

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
        <h2>Chapitre: </h2>
        <p>
            <a href="chapters.php">Retour à la liste des chapitres</a>
        </p>
        <p>
            <a href="index.php">Retour à la page d'Accueil</a>
        </p>

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

        //Recuperation du chapitre
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM chapters WHERE id = ?');
        $req->execute(array($_GET['chapter']));
        $data = $req->fetch();
        if(empty($data))
        {
            echo "Le chapitre n'existe pas";
        }else
        {
        ?>

        <div class="news">
            <h3>
                <?= htmlspecialchars($data['title']); ?>
                <em>le <?= $data['creation_date_fr']; ?></em>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($data['content'])); ?> <br/>
            </p>
        </div>
        <?php
        }
        ?>
        <h3>Commentaires</h3>
        <!-- Formulaire d'ajout de commentaire -->
        <div class="news">
            <form action="comments_post.php?chapter=<?php echo $_GET['chapter'];?>" method="POST">
                <h3> Ajouter votre commentaire:</h3>
                <p>
                    <label for="author">Auteur
                        <input type="text" name="author" id="author" placeholder="Indiquez ici votre nom" value="<?php
                        if (isset($_SESSION['author'])){
                            echo htmlspecialchars($_SESSION['author']);
                        }?>"
                        />
                    </label>
                </p>
                <p>
                    <label for="comment">Commentaire
                        <textarea name="comment" id="comment" placeholder="Indiquez ici votre commentaire"></textarea>
                    </label>
                </p>
                <button>
                    <input type="submit" value="Envoyer votre commentaire"/>
                </button>
            </form>
        </div>
        <?php
        $req->closeCursor(); // on libere le curseur pour la prochaine requete.

        //Recuperation des commentaires
        $req = $db->prepare('SELECT author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id_chapter = ? ORDER BY comment_date');
        $req->execute(array($_GET['chapter']));

        while ($data = $req->fetch())
        {
        ?>
            <p><strong><?= htmlspecialchars($data['author']); ?></strong> le <?= $data['comment_date_fr']; ?></p>
            <p><?= nl2br(htmlspecialchars($data['comment'])); ?></p>
        <?php
        }
        $req->closeCursor();
        ?>
    </body>
</html>