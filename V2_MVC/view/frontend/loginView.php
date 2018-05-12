<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>

    <ul> <!-- avec emmet: ul>li*5>a +[TAB]-->
        <li>
            <a href="../V2_MVC/index.php">Accueil</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=about">À propos</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=listChapters">Chapitres</a>
        </li>
        <li>
            <a href="../V2_MVC/index.php?action=login">Inscription/Connexion</a>
        </li>
    </ul>

<?php $toggle_menu = ob_get_clean(); ?>

<?php ob_start(); ?>

    <h1>Billet simple pour l'Alaska</h1>
    <h2>Nouveau Roman - Jean Forteroche</h2>

    <form action="../V2_MVC/index.php?action=log" method="POST">
        <h3 class="col-md-offset-5 col-md-4">Connexion</h3>
        <p>
            <label for="pseudo">Pseudo
                <input type="text" name="pseudo" id="pseudo" placeholder="Indiquez ici votre nom d'utilisateur" value=""/>
            </label>
        </p>
        <p>
            <label for="pass">Mot de passe
                <input type="password" name="pass" id="pass" placeholder="Indiquez ici votre mot de passe"/>
            </label>
        </p>
        <button>
            <input type="submit" value="Connexion"/>
        </button>
    </form>

    <form action="../V2_MVC/index.php?action=register" method="post">
        <div class="col-md-offset-2 col-md-8">
            <div class="form-group row">
                <h3 class="col-md-offset-5 col-md-4">Inscription</h3>
            </div>
            <div class="form-group row">
                <label for="pseudo" class="col-md-3">Pseudo :</label>
                <div class="col-md-9">
                    <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Php"
                           value="<?php if (isset($_COOKIE['pseudo'])) { echo htmlspecialchars($_COOKIE['pseudo']); }?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-3">Mot de Passe :</label>
                <div class="col-md-9">
                    <input type="password" name="password" id="password" class="form-control" placeholder="MySQL4.4"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirm" class="col-md-3">Confirmation du Mot de Passe :</label>
                <div class="col-md-9">
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="MySQL4.4"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-3">E-mail :</label>
                <div class="col-md-9">
                    <input type="email" name="email" id="email" class="form-control" placeholder="mysql@oc.com"/>
                </div>
            </div>
            <button type="submit" name="inscription" class="btn btn-primary col-md-offset-5 col-md-2">Inscription</button>
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>