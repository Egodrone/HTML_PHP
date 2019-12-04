<?php
$msgAboutUsr = "";
$logOut = "";
if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
    $msgAboutUsr = "<label id='inloggadSt'>Inloggad som: ".$_SESSION['loggedIn']."</label>";
    $logOut = "   <a id='logoutBNav' href='logout.php'>Logga Ut<img height=25px width=25px src='../img/adm.png'></a>";
}
?>
<!doctype html>
<html lang="sv">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=2.0;">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="shortcut icon" href="../img/rip.ico" />
    </head>

    <body>
        <main>
            <article>
                <header class="site-header">
                    <!--
                    <img src="img/logo.png" id="logo" alt="logo" />
                    <span class="site-title">BMO</span>
//-->
                </header>
                <?php $uriFile = basename($_SERVER["REQUEST_URI"]); ?>
                <nav class="navbar">
                    <a class="<?= $uriFile == "index.php" ? "selected" : null ?>" href="../index.php">Hem</a>
                    <a class="<?= $uriFile == "about.php" ? "selected" : null ?>" href="../about.php">Om</a>
                    <a class="<?= $uriFile == "gallery.php" ? "selected" : null ?>" href="../gallery.php">Galleri</a>
                    <a class="<?= $uriFile == "articles.php" ? "selected" : null ?>" href="../articles.php">Artiklar</a>
                    <a class="<?= $uriFile == "search.php" ? "selected" : null ?>" href="../search.php">Sök</a>
                    <a class="<?= $uriFile == "admin.php" ? "selected" : null ?>" href="../admin.php">Admin</a>
                    <strong><label id="navright"><?= $msgAboutUsr.$logOut ?></label></strong>
                </nav>
