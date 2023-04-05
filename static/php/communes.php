<?php
// Initialisation
session_start();
require "./conn_BDD.php";

// On détermine la page actuelle
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = intval($_GET['page']);
}
else{
    $page = 1;
    $_SESSION['page'] = $page;
}

// Définition du nombre de résultats par page
$resultats_par_page = 30;

// Calcul de la compensation tableau/SQL
$compensation = ($page - 1) * $resultats_par_page;

// Récupération des données de la base de données
$assertion = $dbh->prepare("SELECT * FROM villes_france_free LIMIT :compensation, :resultats_par_page");
$assertion->bindParam(':compensation', $compensation, PDO::PARAM_INT);
$assertion->bindParam(':resultats_par_page', $resultats_par_page, PDO::PARAM_INT);
$assertion->execute();
$resultats = $assertion->fetchAll(PDO::FETCH_ASSOC);
?>
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <link rel="shortcut icon" href="static/media/img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/static/css/style.css">
    <title>Registre des communes françaises</title>
</head>
<body>
    <h1 class="communes-h1">Registre des communes françaises</h1>
    <div class="container">
        <table class="communes-table">
            <tr> <!-- Première ligne du tableau -->
                <th>Nom</th> 
                <th>Département</th>
                <th>Code Postal</th>
                <th>Code INSEE</th>
                <th>Population en 1999</th>
                <th>Population en 2010</th>
                <th>Surface</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
            <tbody>
                <?php foreach($resultats as $ligne){ ?>
                <tr> <!-- Contenu de la base de données -->
                    <td><?= $ligne['ville_nom'] ?></td>
                    <td><?= $ligne['ville_departement'] ?></td>
                    <td><?= $ligne['ville_code_postal'] ?></td>
                    <td><?= $ligne['ville_code_commune'] ?></td>
                    <td><?= $ligne['ville_population_1999'] ?></td>
                    <td><?= $ligne['ville_population_2010'] ?></td>
                    <td><?= $ligne['ville_surface'] ?></td>
                    <td><?= $ligne['ville_latitude_deg'] ?></td>
                    <td><?= $ligne['ville_longitude_deg'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
            <?php
            // Calcul du nombre de pages
            $sth = $dbh->query("SELECT COUNT(*) FROM villes_france_free");
            $total_results = $sth->fetchColumn();
            $total_pages = ceil($total_results / $resultats_par_page);

            // Affichage des liens vers les différentes pages
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo "<span class=\"current-page\">$i</span>";
                } else{
                    echo "<a href=\"?page=$i\">$i</a>";
                }
            }
            ?>
</body>
</html>