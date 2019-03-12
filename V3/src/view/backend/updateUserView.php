<?php $title = 'Editer le membre ' . $user['id'] . ' - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <div id="banner" class="row banner-page">
        <div class="nav col-lg-12">
            <?php include('src/view/inc/nav.php') ?>

            <?php if(isset($_SESSION['id'])) { ?>
                <p id="welcome">
                    <a href="../V3/index.php?action=adminUpdateUser&amp;id_user=<?= $_SESSION['id'];?>"><?= 'Bonjour ' . $_SESSION['pseudo']; ?>
                    </a>
                </p>
            <?php } ?>
        </div>
        <div id="banner-title" class="col-lg-8 col-md-10 col-8 offset-lg-2  banner-title-page">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Profil</h2>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>

    <div id="overview" class="row justify-content-center">
        <div class="row col-lg-10 text-center">
            <div class="col-lg-6 col-md-6 col-12">
                <h3>
                    <?= $user['firstname'] ?> <?= $user['surname'];?>
                </h3>
                <br/>
                <p>
                    Pseudo: <?= $user['pseudo']; ?>
                </p>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <p>
                    inscrit depuis le : <em><?= $user['registration_date_fr']; ?></em>
                </p>
                <br/>
                <p>
                    Date de naissance : <em><?= $user['birthday_date_fr']; ?></em>
                </p>
            </div>
        </div>
    </div>
    <div id="inner" class="container col">
        <div id="admin" class="col-lg-10 offset-lg-1 col-12">

        <?php if($user['id'] == $_SESSION['id']) { ?>
        <form action="index.php?action=updatePseudo&amp;id_user=<?= $user['id']; ?>" method="post">
            <div class="col-lg-12">
                <div class="form-group row text-center">
                    <h3 class="col-lg-offset-2 col-lg-10">Modifier mon profil :</h3>
                </div>
                <!-- Pseudo -->
                <div class="form-group row">
                    <label for="pseudo" class="col-lg-3 col-md-2">Pseudo :</label>
                    <div class="col-lg-6 col-md-7">
                        <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Pseudo"
                               value="<?= $user['pseudo']; ?>"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">
                            Enregistrer
                        </button>
                    </div>
                </div>

            </div>
        </form>
        <hr/>
        <!-- Nom & Prenom -->
        <form action="index.php?action=updateName&amp;id_user=<?= $user['id']; ?>" method="post">
            <div class="col-lg-12">
                <div class="form-group row">
                    <div class="col-lg-9 col-md-9">
                        <div class="row">
                            <label for="surname" class="col-lg-4 col-md-3">Nom :</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="surname" id="surname" class="form-control" placeholder="Nom"
                                       value="<?php if (isset($user['surname'])) {
                                           echo $user['surname'];
                                       } ?>"/>
                            </div>
                            <label for="firstname" class="col-lg-4 col-md-3">Prénom :</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Prénom"
                                       value="<?php if (isset($user['firstname'])) {
                                           echo $user['firstname'];
                                       } ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class=" col-lg-3 col-md-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <hr/>
        <!-- Date de naissance -->
        <form action="index.php?action=updateBirthday&amp;id_user=<?= $user['id']; ?>"
              method="post">
            <div class="col-lg-12">
                <div class="form-group row">
                    <label for="birthday_date" class="col-lg-3 col-md-4">Date de naissance :</label>
                    <div class="col-lg-6 col-md-5">
                        <input type="date" max="2019-01-01" min="1948-01-01" name="birthday_date" id="birthday_date"
                               class="form-control" value="<?= $user['birthday_date_form']; ?>"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <hr/>
        <!-- MDP -->
        <form action="index.php?action=updatePass&amp;id_user=<?= $user['id']; ?>" method="post">
            <div class="col-lg-12">
                <div class="form-group row">
                    <div class="col-lg-9 col-md-9">
                        <div class="row">
                            <label for="password" class="col-lg-4 col-md-4">Mot de Passe :</label>
                            <div class="col-lg-8 col-md-8">
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="Mot de passe"/>
                            </div>
                            <label for="password_confirm" class="col-lg-4 col-md-4">Confirmation :</label>
                            <div class="col-lg-8 col-md-8">
                                <input type="password" name="password_confirm" id="password_confirm" class="form-control"
                                       placeholder="Confirmation du mot de passe"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">
                            Enregistrer
                        </button>

                    </div>
                </div>
            </div>
        </form>
        <hr/>
        <!-- Email -->
        <form action="index.php?action=updateEmail&amp;id_user=<?= $user['id']; ?>" method="post">
            <div class="col-lg-12">
                <div class="form-group row">
                    <label for="email" class="col-lg-3 col-md-2">E-mail :</label>
                    <div class="col-lg-6 col-md-7">
                        <input type="email" name="email" id="email" class="form-control" placeholder="nom.prenom@email.com"
                               value="<?php if (isset($user['email'])) {
                                   echo $user['email'];
                               } ?>"/>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">
                            Enregistrer
                        </button>

                    </div>
                </div>
            </div>
        </form>
        <hr/>

        <?php
    }
    ?>
        <!-- Admin -->
    <?php if(isset($_SESSION['id']) && $user['id_group'] == 1) { ?>

        <form action="index.php?action=updateGroup&amp;id_user=<?= $user['id']; ?>" method="post">
            <div class="col-lg-12">
                <div class="form-group row">
                    <div class="col-lg-9 col-md-9">
                        <div class="row align-items-center">
                            <label class="col-form-label col-lg-4 col-md-4">Groupe : </label>
                            <div class="col-lg-8 col-md-7">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="administrator" name="id_group" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="administrator">Administrateur</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="user" name="id_group" class="custom-control-input" value="2">
                                    <label class="custom-control-label" for="user">Membre</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <button type="submit" name="enregistrer" class="btn btn-primary col-lg-offset-2 col-lg-8">Enregistrer</button>
                    </div>
                </div>
            </div>
        </form>
        <hr/>
    <?php
}
?>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('src/view/inc/template.php'); ?>