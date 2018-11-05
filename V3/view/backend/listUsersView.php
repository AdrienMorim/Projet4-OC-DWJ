<?php $title = 'Liste des membres - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <div id="banner" class="row banner-page">
        <div class="nav col-lg-12">
            <?php include('view/inc/nav.php') ?>

            <?php if(isset($_SESSION['id'])) { ?>
                <p id="welcome">
                    <a href="index.php?action=adminUpdateUser&amp;id_user=<?= $_SESSION['id'];?>">Bonjour <?= $_SESSION['pseudo']; ?>
                    </a>
                </p>
            <?php } ?>
        </div>
        <div id="banner-title" class="col-lg-8 col-md-10 col-8 offset-lg-2  banner-title-page">
            <h1>Billet simple pour l'Alaska</h1>
            <h2>Liste des membres</h2>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div id="inner" class="container col">
        <div id="admin" class="col-lg-10 offset-lg-1">
            <div class="text-center">
                <h4>Liste des membres</h4>
            </div>
            <div id="table-blog" class="table-responsive col-lg-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="table-primary">
                            <th class="align-baseline" scope="col">Pseudo</th>
                            <th class="align-baseline" scope="col">Inscription</th>
                            <th class="align-baseline" scope="col">Email</th>
                            <th class="align-baseline level" scope="col">Niveau</th>
                            <th class="align-baseline text-center" scope="col"><i class="fas fa-pen-square"></i></th>
                            <th class="align-baseline text-center" scope="col"><i class="fas fa-trash-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($user = $users->fetch()) { ?>
                        <tr>
                            <th class="align-middle">
                                <?= htmlspecialchars($user['pseudo']); ?>
                            </th>
                            <td class="align-middle">
                                <?= htmlspecialchars($user['registration_date_fr']); ?>
                            </td>
                            <td class="align-middle">
                                <?= htmlspecialchars($user['email']); ?>
                            </td>
                            <td class="align-middle level">
                                <?php if(($user['id_group']) == 1){ echo 'Administrateur'; } else{ echo 'Membre'; } ?>
                            </td>
                            <td class="align-middle text-center">
                                <a href="index.php?action=adminUpdateUser&amp;id_user=<?= $user['id']; ?>">Modifier</a>
                            </td>
                            <td class="align-middle text-center">
                                <a href="index.php?action=deleteUser&amp;id_user=<?= $user['id']; ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php
                    } // fin de la boucle des chapitres
                    $users->closeCursor(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php $content = ob_get_clean(); ?>

<?php require('view/inc/template.php'); ?>