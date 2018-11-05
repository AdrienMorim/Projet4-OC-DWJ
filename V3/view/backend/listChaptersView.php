<?php $title = 'Liste des Chapitres - Billet simple pour l\'Alaska'; ?>

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
            <h2>Liste des chapitres</h2>
        </div>
    </div>

<?php $header = ob_get_clean(); ?>

<?php ob_start(); ?>
    <div id="inner" class="container col">
        <div id="admin" class="col-lg-10 offset-lg-1">
            <div class="text-right col-lg-3 offset-lg-9">
                <a href="../V3/index.php?action=adminNewChapter"><i class="fas fa-pencil-alt"></i> Créer un chapitre</a>
            </div>
            <div id="table-blog" class="table-responsive col-lg-12">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr class="table-primary">
                        <?php if(!isset($_SESSION['id_group']) || isset($_SESSION) && $_SESSION['id_group'] == 2) { ?>
                            <th class="align-baseline" scope="col">Titre </th>
                            <th class="align-baseline" scope="col">Date</th>
                            <th class="align-baseline" scope="col">Aperçu</th>
                        <?php } else { ?>
                            <th class="align-baseline" scope="col">Titre </th>
                            <th class="align-baseline" scope="col">Date</th>
                            <th class="align-baseline" scope="col">Aperçu</th>
                            <th class="align-baseline text-center" scope="col"><i class="fas fa-pen-square"></i></th>
                            <th class="align-baseline text-center" scope="col"><i class="fas fa-trash-alt"></i></th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($data = $chapters->fetch()) { ?>
                        <tr>
                            <th class="align-middle" scope="row"><?= htmlspecialchars($data['title']); ?></th>
                            <td class="align-middle"> <?= $data['creation_date_fr']; ?></td>
                            <td class="align-middle"> <?= nl2br(htmlspecialchars(substr($data['content'], 0, 100))); ?>...
                                <div class="text-right">
                                    <a href="../V3/index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">
                                        <em>Voir la suite</em>
                                    </a>
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                <a href="../V3/index.php?action=adminUpdateChapter&amp;id_chapter=<?= $data['id']; ?>">Éditer</a>
                            </td>
                            <td class="align-middle text-center">
                                <a href="../V3/index.php?action=deleteChapter&amp;id_chapter=<?= $data['id']; ?>">Supprimer</a>
                            </td>
                        </tr>
                        <?php
                    } // fin de la boucle des chapitres

                    $chapters->closeCursor();
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php
                        for ($i = 1; $i <= $nbPages; $i++){
                            if ($i == $current_page){
                                echo '<li class="page-item disabled"><a class="page-link" href="#"> ' . $i . ' </a></li>';
                            }else{
                                echo '<li class="page-item"><a class="page-link" href="../V3/index.php?action=listChapters&page=' . $i . '"> ' . $i . ' </a></li>';
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('../V3/view/inc/template.php'); ?>