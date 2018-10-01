<?php $title = 'Editer le commentaire ' . htmlspecialchars($comment['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <div id="banner" class="row banner-page">
        <div class="nav col-lg-12">
            <?php include('../V3/view/inc/nav.php') ?>

            <?php if(isset($_SESSION['id'])) { ?>
                <p id="welcome">
                    <a href="../V3/index.php?action=adminUpdateUser&amp;id_user=<?= $_SESSION['id'];?>">Bonjour <?= $_SESSION['pseudo']; ?>
                    </a>
                </p>
            <?php } ?>
        </div>
        <div id="banner-title" class="col-lg-8 col-md-10 col-8 offset-lg-2  banner-title-page">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Éditer le commentaire de: </h2>
            <p><?= htmlspecialchars($comment['author']); ?><em> du <?= htmlspecialchars($comment['comment_date_fr']); ?></em><br/>
                <?= htmlspecialchars($comment['comment']); ?>
            </p>
        </div>
    </div>


<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <div id="inner" class="container col">
        <div id="admin" class="col-lg-10 offset-lg-1">
            <div class="text-center">

                <h3>
                    <?= htmlspecialchars($chapter['title']); ?>
                    <em>le <?= $chapter['creation_date_fr']; ?></em>
                </h3>
                <p>
                    <?= nl2br(htmlspecialchars($chapter['content'])); ?> <br/>
                </p>
            </div>
            <form action="../V3/index.php?action=updateComment&amp;id_chapter=<?= $_GET['id_chapter']; ?>&amp;id=<?= $_GET['id']; ?>" method="POST">
                <div class="col-lg-12">
                    <div class="form-group row">
                        <label for="author" class="col-lg-3">Auteur</label>
                        <div class="col-lg-9">
                            <input type="text" name="author" id="author" class="form-control" value="<?= htmlspecialchars($comment['author']); ?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-lg-3">Commentaire</label>
                        <div class="col-lg-9">
                            <textarea name="comment" id="comment" class="form-control" placeholder="<?= htmlspecialchars($comment['comment']); ?>"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 text-right">
                            <button type="submit" name="envoyer" class="btn btn-primary">Mettre à jour votre commentaire</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>