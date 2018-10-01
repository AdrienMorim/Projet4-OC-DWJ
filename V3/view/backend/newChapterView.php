<?php $title = 'Créer un nouveau Chapitre - Billet simple pour l\'Alaska'; ?>

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
            <h2>Création d'un nouveau chapitre</h2>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

<div id="inner" class="container col">
    <div id="admin" class="col-lg-10 offset-lg-1">
        <form action="../V3/index.php?action=createChapter" method="POST">
            <div class="col-lg-12">
                <div class="form-group row">
                    <label for="author" class="col-lg-3">Auteur</label>
                    <div class="col-lg-9">
                        <input type="text" name="author" id="author" class="form-control" value="<?php
                        if (isset($_SESSION['pseudo']))
                        {
                            echo htmlspecialchars($_SESSION['pseudo']);
                        }
                        ?>"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-lg-3">Titre</label>
                    <div class="col-lg-9">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Indiquez ici votre titre"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="content" class="col-lg-3">Chapitre</label>
                    <div class="col-lg-9">
                        <textarea name="content" id="content" class="form-control" placeholder="Indiquez ici votre chapitre"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-9 text-right">
                    <button type="submit" name="envoyer" class="btn btn-primary">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>

