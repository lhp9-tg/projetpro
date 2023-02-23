<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/img/logo.png">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>The Retrospective, la liste complète des films qui vous avez vu</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="."><img src="../assets/img/logo.png" alt="logo de bobine par freePNG.fr"> </a>
            <h1 class="title">The Retrospective</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../controllers/home.php">Accueil</a></li>
                <?= (isset($_SESSION['user'])) ? '<li><a href="../controllers/login.php?logout">Se déconnecter</a></li>' : '<li><a href="../controllers/login.php">Se connecter</a></li>' ?>
                <?= (isset($_SESSION['user'])) ? '<li><a href="../controllers/explorer.php">Explorer</a></li>' : '<li><a href="../controllers/signin.php">S\'inscrire</a></li>' ?>
            </ul>
        </nav>
    </header>
    <main>