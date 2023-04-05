<?php
// Ce programme permet de se connecter à la base de données.
$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", "PDO::ERRMODE_EXCEPTION"
  ];
$nom_de_domaine = "localhost";
$base_de_donnees = "villes_francaises";
$utilisateur = "root";
$mot_de_passe = "";
$dsn = "mysql:host=$nom_de_domaine;dbname=$base_de_donnees";
$dbh = new PDO($dsn, $utilisateur, $mot_de_passe, $options);
if (!$dbh) {
  die("Connexion échouée: " . print_r($dbh->errorInfo(), true));
}