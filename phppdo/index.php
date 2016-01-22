<?php

include '../Benchmark.php';

$benchmark = new benchmark();

$dsn = 'memoire';
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
