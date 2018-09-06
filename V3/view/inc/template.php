<!--<?php

/*if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{

}
*/?> -->

<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include('../V3/view/inc/header.php') ?>
        <title> <?= $title ?> </title>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <header id="header" class="container col">
                    <?= $header ?>
                </header>

                <section id="body" class="container col">
                    <?= $content ?>
                </section>

                <footer id="footer" class="container col">
                    <?php include('../V3/view/inc/footer.php'); ?>
                </footer>
            </div>
        </div>
        <script type="text/javascript" src="../V3/public/js/toggle.js"></script>
        <script type="text/javascript" src="../V3/public/js/main.js"></script>
    </body>
</html>