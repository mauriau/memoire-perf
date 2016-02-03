<?php
include '../Benchmark4.php';

//$benchmark = new benchmark();
// on se connect à localhost au port 3307
$link = mysql_connect('127.0.0.1:3307', 'root', 'root');
if (!$link) {
    die('Connexion impossible : ' . mysql_error());
}


if (!mysql_select_db('classicmodels', $link)) {
    echo 'Sélection de base de données impossible';
    exit;
}

$sql    = 'SHOW TABLES';
$result = mysql_query($sql, $link);

if (!$result) {
    echo "Erreur DB, impossible d'effectuer une requête\n";
    echo 'Erreur MySQL : ' . mysql_error();
    exit;
}
var_dump($result);
while ($row = mysql_fetch_assoc($result)) {
    echo $row['foo'];
}

mysql_free_result($result);
