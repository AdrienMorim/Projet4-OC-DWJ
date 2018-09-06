<?php $title = 'Connexion / Inscription'; ?>

<?php ob_start(); ?>

    <div id="banner" class="row banner-page">
        <div class="nav col-lg-12">
            <?php include('../V3/view/inc/nav.php') ?>
        </div>
        <div id="banner-title" class="col-lg-6 offset-lg-3  banner-title-page">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Nouveau Roman - Jean Forteroche</h2>
            <h3>Connexion / Inscription</h3>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <div id="inner" class="row justify-content-lg-center">
        <aside id="login" class="card col-lg-5">
            <form action="../V3/index.php?action=log" method="POST">
                <div class="col-lg-12 card-header text-center">
                    <div class="form-group row">
                        <h3 class="offset-lg-3 col-lg-6">Connexion</h3>
                    </div>
                </div>
                <div class="col-lg-12 card-body">
                    <div class="form-group row">
                        <label for="pseudo" class="col-lg-6">Pseudo :</label>
                        <div class="col-lg-12">
                            <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Pseudo"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-lg-6">Mot de Passe :</label>
                        <div class="col-lg-12">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 offset-lg-4">
                            <button type="submit" name="connexion"  class="btn btn-primary">Connexion
                            </button>
                        </div>
                    </div>
            </form>
        </aside>
        <aside id="register" class="card col-lg-5 offset-lg-1">
            <form action="../V3/index.php?action=register" method="post">
                <div class="col-lg-12 card-header text-center">
                    <div class="form-group row">
                        <h3 class="offset-lg-3 col-lg-6">Inscription</h3>
                    </div>
                </div>
                <div class="col-lg-12 card-body">
                    <div class="form-group row">
                        <label for="pseudo" class="col-lg-10">Pseudo :</label>
                        <div class="col-lg-12">
                            <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Pseudo"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-lg-10">Mot de Passe :</label>
                        <div class="col-lg-12">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirm" class="col-lg-10">Confirmation du Mot de Passe :</label>
                        <div class="col-lg-12">
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Mot de passe"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-lg-10">E-mail :</label>
                        <div class="col-lg-12">
                            <input type="email" name="email" id="email" class="form-control" placeholder="nom.prenom@email.com"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 offset-lg-4">
                            <button type="submit" name="inscription" class="btn btn-primary">Inscription
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </aside>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>