<?php $title = 'Liste des Chapitres - Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

    <div id="banner" class="row banner-page">
        <div class="nav col-lg-12">
            <?php include('view/inc/nav.php') ?>

            <?php if(isset($_SESSION['id'])) { ?>
                <p id="welcome">
                    <a href="../V3/index.php?action=adminUpdateUser&amp;id_user=<?= $_SESSION['id'];?>"><?= 'Bonjour ' . $_SESSION['pseudo']; ?>
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

    <article id="overview">
        <?php while ($data = $chapters->fetch()) { ?>
            <aside id="listChapter" class="row col-lg-12 align-items-center">
                <div class="col-lg-3 offset-lg-1 col-md-4">
                    <a href="../V3/index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">
                        <div class="chapter-img"><?= $data['title']; ?> </div>
                    </a>
                </div>
                <div class="col-lg-7 offset-lg-1 col-md-8">
                    <h4 class="align-middle" scope="row"><?= $data['title']; ?></h4>
                    <h5 class="text-muted align-middle"> <?= $data['creation_date_fr']; ?></h5>
                    <p class="align-middle"> <?= substr(htmlspecialchars_decode($data['content']), 0, 200); ?>...

                    </p>
                    <p class="text-right">
                        <a href="../V3/index.php?action=chapter&amp;id_chapter=<?= $data['id']; ?>">
                            <em>Voir la suite <i class="fas fa-arrow-alt-circle-right"></i></em>
                        </a>
                    </p>
                </div>

            </aside>
        <hr/>
            <?php
        } // fin de la boucle des chapitres

        $chapters->closeCursor(); ?>

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

    </article>

<?php $content = ob_get_clean(); ?>

<?php require('view/inc/template.php'); ?>