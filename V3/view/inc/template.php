<?php

if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'] . ', tu es admin de level: ' . $_SESSION['id_group'];
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include('../V3/view/inc/header.php') ?>
        <title> <?= $title ?> </title>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">

                <header id="header" class="container col-lg-12">
                    <div class="row">
                        <div class="col-lg-2">
                            <?php include('../V3/view/inc/nav.php') ?>
                        </div>
                        <div class="col-lg-8">
                            <?= $header ?>
                        </div>
                    </div>
                </header>

                <section class="container col-lg-8 offset-lg-2">
                    <?= $content ?>
                </section>

                <footer id="footer" class="container col-lg-12">
                    <?php include('../V3/view/inc/footer.php'); ?>
                </footer>

            </div>
        </div>
    </body>
</html>