<?php $title = 'Ajout d\'un membre - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Ajout d'un membre</h2>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <form action="../V3/index.php?action=newUser" method="post">
        <div class="col-lg-12">
            <div class="form-group row">
                <h3 class="col-lg-offset-5 col-lg-4">Inscription d'un nouveau membre</h3>
            </div>
            <div class="form-group row">
                <label for="pseudo" class="col-lg-3">Pseudo :</label>
                <div class="col-lg-9">
                    <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Pseudo" value=""/>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-lg-3">Mot de Passe :</label>
                <div class="col-lg-9">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirm" class="col-lg-3">Confirmation du Mot de Passe :</label>
                <div class="col-lg-9">
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Mot de passe"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-lg-3">E-mail :</label>
                <div class="col-lg-9">
                    <input type="email" name="email" id="email" class="form-control" placeholder="nom.prenom@email.com"/>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-lg-3">Groupe: </legend>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="admin" name="id_group" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="admin">Administrateur</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="user" name="id_group" class="custom-control-input" value="2">
                            <label class="custom-control-label" for="user">Membre</label>
                        </div>
                </div>
            </fieldset>
            <div class="form-group row">
                <div class="col-lg-9">
                    <button type="submit" name="inscription" class="btn btn-primary col-lg-offset-5 col-lg-4">Ajouter le membre</button>

                </div>
            </div>
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>