<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/img/logo.png">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>The Retrospective</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="."><img src="../assets/img/logo.png" alt="logo de bobine par freePNG.fr"> </a>
            <h1><a  class="title" href="/controllers/home.php">The Retrospective</a></h1>
        </div>
        <nav>
            <ul>
                <?= (isset($_SESSION['user'])) ? '<li><a href="../controllers/login.php?logout">Se déconnecter</a></li>' : '<li><a href="../controllers/login.php">Se connecter</a></li>' ?>
                <?= (isset($_SESSION['user'])) ? '<li><a href="../controllers/explorer.php">Chercher</a></li>' : '<li><a href="../controllers/signin.php">S\'inscrire</a></li>' ?>
                <?= (isset($_SESSION['user']) && ($_SESSION['user']['retrospective_active'] === true)) ? '<li><a href="../controllers/my_list.php">Mon profil</a></li>' : '' ?>
                <?= (isset($_SESSION['user']) && ($_SESSION['user']['retrospective_active'] === true)) ? '<li><a href="../controllers/timeline.php">Ma rétrospective</a></li>' : '' ?>


            </ul>
        </nav>
    </header>
    <main>
            <?php if (isset($_SESSION['user'])) { ?>
                    <p style="position : absolute; right : 30px;">Bonjour <?= $_SESSION['user']['username'] ?></p>
            <?php } ?>
