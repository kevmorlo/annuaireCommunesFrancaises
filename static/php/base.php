<?php
// On vient changer le chemin d'accès au favicon ainsi qu'au css en fonction de la page
if(basename($_SERVER['PHP_SELF']) == "index.php") {
    $favicon = "/static/media/img/icone.ico";
    $css = "/static/css/style.css";
} 
else {
    $favicon = "../media/img/icone.ico";
    $css = "../css/style.css";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= $favicon ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= $css ?>">
    <title>Registre des communes françaises</title>
</head>
<body>
    <nav>
        <div class="menu">
        <?php // On vient afficher le bouton pour retourner à l'acceuil sur toutes les pages sauf index.php
        if(basename($_SERVER['PHP_SELF']) != "index.php") {
        ?>
            <a href="../../index.php">
                <img src="../media/img/icone_accueil.svg" alt="Accueil" title="Accueil" class="base_icon">
            </a>
        <?php
        }
        if(basename($_SERVER['PHP_SELF']) != "communes.php" && basename($_SERVER['PHP_SELF']) != "index.php") {
        ?>
            <a href="./communes.php">
                <img src="../media/img/icone_boites.svg" alt="Registre des communes" title="Registre des communes" class="base_icon">
            </a>
        <?php
        }
        ?>
        </div>
    </nav>
</body>
</html>