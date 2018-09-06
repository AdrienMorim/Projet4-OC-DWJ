<?php $title = 'Editer le membre ' . htmlspecialchars($user['id']) . ' - Billet simple pour l\'Alaska'; ?>

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
        <div id="banner-title" class="col-lg-6 offset-lg-3  banner-title-page">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Profil</h2>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <div id="overview" class="row justify-content-center">
        <div class="row col-lg-10 text-center">
            <div class="col-lg-6">
                <h3>
                    <?= htmlspecialchars($user['pseudo']); ?>
                </h3>
                <br/>
                <p>
                    <?= htmlspecialchars($user['firstname']) ?> <?= htmlspecialchars($user['surname']);?>
                </p>
            </div>
            <div class="col-lg-6">
                <p>
                    inscrit depuis le : <em><?= htmlspecialchars($user['registration_date_fr']); ?></em>
                </p>
                <br/>
                <p>
                    Date de naissance : <?= htmlspecialchars($user['birthday_date_fr']); ?>
                </p>
            </div>
        </div>
    </div>
    <div id="inner" class="container col-lg-12">
        <div id="admin" class="col-lg-10 offset-lg-1">

        <?php if($user['id'] == $_SESSION['id']) { ?>
        <form action="../V3/index.php?action=updatePseudo&amp;id_user=<?= htmlspecialchars($user['id']); ?>" method="post">
            <div class="col-lg-12">
                <div class="form-group row text-center">
                    <h3 class="col-lg-offset-2 col-lg-10">Modifier mon profil :</h3>
                </div>
                <!-- Pseudo -->
                <div class="form-group row">
                    <label for="pseudo" class="col-lg-3">Pseudo :</label>
                    <div class="col-lg-6">
                        <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Pseudo"
                               value="<?= htmlspecialchars($user['pseudo']); ?>"/>
                    </div>
                    <div class="col-lg-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">
                            Enregistrer
                        </button>
                    </div>
                </div>
                <hr/>
            </div>
        </form>
        <!-- Nom & Prenom -->
        <form action="../V3/index.php?action=updateName&amp;id_user=<?= htmlspecialchars($user['id']); ?>" method="post">
            <div class="col-lg-12">
                <div class="form-group row">
                    <div class="col-lg-9">
                        <div class="row">
                            <label for="surname" class="col-lg-4">Nom :</label>
                            <div class="col-lg-8">
                                <input type="text" name="surname" id="surname" class="form-control" placeholder="Nom"
                                       value="<?php if (isset($user['surname'])) {
                                           echo htmlspecialchars($user['surname']);
                                       } ?>"/>
                            </div>
                            <label for="firstname" class="col-lg-4">Prénom :</label>
                            <div class="col-lg-8">
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Prénom"
                                       value="<?php if (isset($user['firstname'])) {
                                           echo htmlspecialchars($user['firstname']);
                                       } ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">
                            Enregistrer
                        </button>
                    </div>
                </div>
                <hr/>
            </div>
        </form>
        <!-- Date de naissance -->
        <form action="../V3/index.php?action=updateBirthday&amp;id_user=<?= htmlspecialchars($user['id']); ?>"
              method="post">
            <div class="col-lg-12">
                <div class="form-group row">
                    <label for="birthday_date" class="col-lg-3">Date de naissance :</label>
                    <div class="col-lg-6">
                        <input type="date" max="2018-01-01" min="1948-01-01" name="birthday_date" id="birthday_date"
                               class="form-control" placeholder="" value="<?php if (isset($user['birthday_date'])) {
                            echo htmlspecialchars($user['birthday_date']);
                        } ?>"/>
                    </div>
                    <div class="col-lg-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">
                            Enregistrer
                        </button>
                    </div>
                </div>
                <hr/>
            </div>
        </form>
        <!-- MDP -->
        <form action="../V3/index.php?action=updatePass&amp;id_user=<?= htmlspecialchars($user['id']); ?>" method="post">
            <div class="col-lg-12">
                <div class="form-group row">
                    <div class="col-lg-9">
                        <div class="row">
                            <label for="password" class="col-lg-4">Mot de Passe :</label>
                            <div class="col-lg-8">
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="Mot de passe"/>
                            </div>
                            <label for="password_confirm" class="col-lg-4">Confirmation :</label>
                            <div class="col-lg-8">
                                <input type="password" name="password_confirm" id="password_confirm" class="form-control"
                                       placeholder="Confirmation du mot de passe"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">
                            Enregistrer
                        </button>

                    </div>
                </div>
                <hr/>
            </div>
        </form>
        <!-- Email -->
        <form action="../V3/index.php?action=updateEmail&amp;id_user=<?= htmlspecialchars($user['id']); ?>" method="post">
            <div class="col-lg-12">
                <div class="form-group row">
                    <label for="email" class="col-lg-3">E-mail :</label>
                    <div class="col-lg-6">
                        <input type="email" name="email" id="email" class="form-control" placeholder="nom.prenom@email.com"
                               value="<?php if (isset($user['email'])) {
                                   echo htmlspecialchars($user['email']);
                               } ?>"/>
                    </div>
                    <div class="col-lg-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">
                            Enregistrer
                        </button>

                    </div>
                </div>
                <hr/>
            </div>
        </form>

        <?php
    }
    ?>
                <!-- Admin -->
    <?php if(isset($_SESSION) && $_SESSION['id_group'] == 1) { ?>

        <form action="../V3/index.php?action=updateGroup&amp;id_user=<?= htmlspecialchars($user['id']); ?>" method="post">
            <div class="col-lg-12">
                <div class="form-group row">
                    <div class="col-lg-9">
                        <div class="row align-items-center">
                            <label class="col-form-label col-lg-4">Groupe : </label>
                            <div class="col-lg-8">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="admin" name="id_group" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="admin">Administrateur</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="user" name="id_group" class="custom-control-input" value="2">
                                    <label class="custom-control-label" for="user">Membre</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">Enregistrer</button>
                    </div>
                </div>
            </div>
        </form>
    <?php
}
?>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>