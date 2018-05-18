<?php $title = 'Connexion / Inscription'; ?>

<?php ob_start(); include('../V2_MVC/view/nav.php'); $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Connexion / Inscription</h2>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <form action="../V2_MVC/index.php?action=log" method="POST">
        <div class="col-lg-12">
            <div class="form-group row">
                <h3 class="col-lg-offset-5 col-lg-4">Connexion</h3>
            </div>
            <div class="form-group row">
                <label for="pseudo" class="col-md-3">Pseudo :</label>
                <div class="col-md-9">
                    <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Pseudo"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-3">Mot de Passe :</label>
                <div class="col-md-9">
                    <input type="password" name="pass" id="password" class="form-control" placeholder="Mot de passe"/>
                </div>
            </div>
            <button type="submit" name="connexion"  class="btn btn-primary">Connexion</button>
    </form>

    <form action="../V2_MVC/index.php?action=register" method="post">
        <div class="col-lg-12">
            <div class="form-group row">
                <h3 class="col-lg-offset-5 col-lg-4">Inscription</h3>
            </div>
            <div class="form-group row">
                <label for="pseudo" class="col-md-3">Pseudo :</label>
                <div class="col-md-9">
                    <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Pseudo"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-3">Mot de Passe :</label>
                <div class="col-md-9">
                    <input type="password" name="pass" id="password" class="form-control" placeholder="Mot de passe"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirm" class="col-md-3">Confirmation du Mot de Passe :</label>
                <div class="col-md-9">
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Mot de passe"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-3">E-mail :</label>
                <div class="col-md-9">
                    <input type="email" name="email" id="email" class="form-control" placeholder="nom.prenom@email.com"/>
                </div>
            </div>
            <button type="submit" name="inscription" class="btn btn-primary col-md-offset-5 col-md-2">Inscription</button>
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); include('../V2_MVC/view/footer.php'); $footer = ob_get_clean(); ?>

<?php require('../V2_MVC/view/template.php'); ?>