<?php
// initialisation
include "./conn_BDD.php"
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
<?php
// on note dans un tableau les noms des villes de la bdd
$sth = $dbh->prepare("SELECT ville_nom FROM villes_france_free");
$sth->execute();
$noms = $sth->fetchAll();

// on fait de même pour les départements
$sth = $dbh->prepare("SELECT ville_departement FROM villes_france_free");
$sth->execute();
$departements = $sth->fetchAll();

// pour les code postaux
$sth = $dbh->prepare("SELECT ville_code_postal FROM villes_france_free");
$sth->execute();
$codes_postaux = $sth->fetchAll();

// les codes insee
$sth = $dbh->prepare("SELECT ville_code_commune FROM villes_france_free");
$sth->execute();
$codes_insee = $sth->fetchAll();

// la population en 1999 des différentes villes
$sth = $dbh->prepare("SELECT ville_population_1999 FROM villes_france_free");
$sth->execute();
$pops_99 = $sth->fetchAll();

// la population en 2010 des différentes villes
$sth = $dbh->prepare("SELECT ville_population_2010 FROM villes_france_free");
$sth->execute();
$pops_10 = $sth->fetchAll();

// les surfaces
$sth = $dbh->prepare("SELECT ville_surface FROM villes_france_free");
$sth->execute();
$surfaces = $sth->fetchAll();

// les latitudes
$sth = $dbh->prepare("SELECT ville_latitude_deg FROM villes_france_free");
$sth->execute();
$latitudes = $sth->fetchAll();

// et les longitudes
$sth = $dbh->prepare("SELECT ville_longitude_deg FROM villes_france_free");
$sth->execute();
$longitudes = $sth->fetchAll();
?>
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
                <tr>
                    <td><?php  ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>