<?php
// Initialisation
session_start();
require "./conn_BDD.php";
require "./base.php";

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
<body>
    <h1 class="communes-h1">Registre des communes françaises</h1>
    <div class="container">
        <table class="communes-table">
            <tbody>
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
        $resultats_totaux = $sth->fetchColumn();
        $pages_totales = ceil($resultats_totaux / $resultats_par_page);

        // Nombre maximum de liens de page à afficher avant et après la page actuelle
        $max_liens_avant_apres = 5;

        // Affichage des liens vers les différentes pages
        if ($page > 1) : ?>
            <a href="?page=1">&laquo;&laquo;</a>
            <a href="?page=<?= $page - 1 ?>">&laquo;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $pages_totales; $i++) : ?>
            <?php if ($i == $page) : ?>
                <span class="current-page"><?= $i ?></span>
            <?php else : ?>
                <?php
                $min_lien = max(1, $page - $max_liens_avant_apres);
                $max_lien = min($pages_totales, $page + $max_liens_avant_apres);
                if ($i >= $min_lien && $i <= $max_lien) :
                ?>
                    <a href="?page=<?= $i ?>"><?= $i ?></a>
                <?php elseif ($i == $min_lien - 1 || $i == $max_lien + 1) : ?>
                    <span class="pagination-separator">&hellip;</span>
                <?php endif; ?>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($page < $pages_totales) : ?>
            <a href="?page=<?= $page + 1 ?>">&raquo;</a>
            <a href="?page=<?= $pages_totales ?>">&raquo;&raquo;</a>
        <?php endif; ?>
    </div>
</body>
</html>