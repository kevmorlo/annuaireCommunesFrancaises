<?php
// Initialisation
session_start();
require "./conn_BDD.php";
require "./base.php";

// On détermine l'id de la commune
$id = $_GET['id'];

// Récupération des données de la base de données
$assertion = $dbh->prepare("SELECT ville_id, ville_nom, ville_departement, ville_code_postal, ville_code_commune, ville_population_1999, ville_population_2010, ville_surface, ville_latitude_deg, ville_longitude_deg FROM villes_france_free WHERE ville_id = $id");
$assertion->execute();
$resultat = $assertion->fetchAll(PDO::FETCH_ASSOC);
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
                <?php foreach($resultat as $ligne){ ?>
                <tr><a href="commune.php?id=<?= $ligne['ville_id'] ?>"></a> <!-- Contenu de la base de données -->
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
</body>