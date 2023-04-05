<?php
// Ce programme permet de se connecter à la base de données.
$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", "PDO::ERRMODE_EXCEPTION"
  ];
$hostname = "localhost";
$base_de_donnees = "villes_francaises";
$user = "root";
$password = "";
$dsn = "mysql:host=$hostname;dbname=$base_de_donnees";
$dbh = new PDO($dsn, $user, $password, $options);