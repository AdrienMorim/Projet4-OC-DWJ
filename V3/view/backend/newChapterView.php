<?php $title = 'Créer un nouveau Chapitre - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<h2>Création d'un nouveau chapitre</h2>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

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
            <div class="col-lg-9">
            <button type="submit" name="envoyer" class="btn btn-primary">Envoyer</button>
            </div>
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>

