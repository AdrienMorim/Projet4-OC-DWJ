<?php $title = 'Editer le membre ' . htmlspecialchars($user['id']) . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); include('../V2_MVC/view/nav.php'); $menu = ob_get_clean(); ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Éditer le membre: </h2>
    <div class="news">
        <h3>
            <?= htmlspecialchars($user['id']); ?>
        </h3>
        <h4>
            <?= htmlspecialchars($user['pseudo']); ?>
        </h4>
        <p>
            <em><?= htmlspecialchars($user['pass']); ?></em>
        </p>
        <p>
            <?= htmlspecialchars($user['email']); ?>
        </p>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <form action="../V2_MVC/index.php?action=updateUser&amp;id_user=<?= htmlspecialchars($user['id']); ?>" method="post">
        <div class="col-lg-12">
            <div class="form-group row">
                <h3 class="col-lg-offset-2 col-lg-10">Modifier le membre: <?= htmlspecialchars($user['pseudo']); ?></h3>
            </div>
            <div class="form-group row">
                <label for="pseudo" class="col-lg-3">Pseudo :</label>
                <div class="col-lg-9">
                    <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Pseudo" value="<?= htmlspecialchars($user['pseudo']); ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="surname" class="col-lg-3">Nom :</label>
                <div class="col-lg-9">
                    <input type="text" name="surname" id="surname" class="form-control" placeholder="Nom" value="<?php if(isset($user['surname'])){ echo htmlspecialchars($user['surname']); } ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="firstname" class="col-lg-3">Prénom :</label>
                <div class="col-lg-9">
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Prénom" value="<?php if(isset($user['firstname'])){ echo htmlspecialchars($user['firstname']); } ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="birthday_date" class="col-lg-3">Date de naissance :</label>
                <div class="col-lg-9">
                    <input type="date" max="2018-01-01" min="1948-01-01" name="birthday_date" id="birthday_date" class="form-control" placeholder="" value="<?php if(isset($user['birthday_date'])){ echo htmlspecialchars($user['birthday_day']); } ?>"/>
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
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Confirmation du mot de passe"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-lg-3">E-mail :</label>
                <div class="col-lg-9">
                    <input type="email" name="email" id="email" class="form-control" placeholder="nom.prenom@email.com" value="<?php if(isset($user['email'])){ echo htmlspecialchars($user['email']); } ?>"/>
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
                    <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-5 col-lg-4">Enregistrer</button>

                </div>
            </div>
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); include('../V2_MVC/view/footer.php'); $footer = ob_get_clean(); ?>

<?php require('../V2_MVC/view/template.php'); ?>