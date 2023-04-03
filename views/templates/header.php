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
            <a href="/controllers/home.php"><img src="../assets/img/logo_inverse.png" alt="logo de bobine" style="margin-left : 10px"> </a>
            <h1><a class="title" href="/controllers/home.php">The Retrospective</a></h1>
        </div>
        <nav>
            <a id="link" href="#"><span id="burger"></span></a>
            <ul class="menu">
                <?= (isset($_SESSION['user'])) ? '<li><a href="../controllers/explorer.php">Ajouter</a></li>' : '<li><a href="../controllers/signin.php">S\'inscrire</a></li>' ?>
                <?= (isset($_SESSION['user']) && ($_SESSION['user']['retrospective_active'] === true)) ? '<li><a href="../controllers/my_list.php">Mes films</a></li>' : '' ?>
                <?= (isset($_SESSION['user']) && ($_SESSION['user']['retrospective_active'] === true)) ? '<li><a href="../controllers/carousel.php">Ma rétrospective</a></li>' : '' ?>
                <?= (isset($_SESSION['user'])) ? '<li><a href="../controllers/login.php?logout">Se déconnecter</a></li>' : '<li><a href="../controllers/login.php">Se connecter</a></li>' ?>
            </ul>
        </nav>
    </header>
    <main>
            <ul class="menu_list">
                <?= (isset($_SESSION['user'])) ? '<li><a href="../controllers/explorer.php">Ajouter</a></li>' : '<li><a href="../controllers/signin.php">S\'inscrire</a></li>' ?>
                <?= (isset($_SESSION['user']) && ($_SESSION['user']['retrospective_active'] === true)) ? '<li><a href="../controllers/my_list.php">Mes films</a></li>' : '' ?>
                <?= (isset($_SESSION['user']) && ($_SESSION['user']['retrospective_active'] === true)) ? '<li><a href="../controllers/carousel.php">Ma rétrospective</a></li>' : '' ?>
                <?= (isset($_SESSION['user'])) ? '<li><a href="../controllers/login.php?logout">Se déconnecter</a></li>' : '<li><a href="../controllers/login.php">Se connecter</a></li>' ?>
            </ul>