<?php
include '../Benchmark.php';

$benchmark = new benchmark();
// on se connect à localhost au port 3307
$link = mysql_connect('127.0.0.1:3307', 'root', 'root');
if (!$link) {
    die('Connexion impossible : ' . mysql_error());
}
echo 'Connecté correctement';
mysql_close($link);
