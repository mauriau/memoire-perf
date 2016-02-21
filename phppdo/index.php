<?php

include '../BenchmarkTimer.php';
$totalMemory = memory_get_usage($real);
$benchmark = new BenchmarkTimer(false);

$dsn = 'mysql:host=localhost;dbname=classicmodels';
$user = 'root';
$password = 'root';
$real = false;
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

function geResult($sql, $dbh, $action = false)
{
    if (false != $action) {

        for ($i = 100; $i <= 1100; $i++) {
            $sth = $dbh->prepare($sql);
            return $sth->execute(array($i));
        }
    }

    for ($i = 100; $i <= 1100; $i++) {
        $sth = $dbh->prepare($sql);
        $sth->execute();
    }
}

$sql = "select * from orderdetails";
$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $dbh);
$pick = memory_get_peak_usage($real);
$benchmark->stop($pick, 'SELECT *');
$sql = "select count(*) from orderdetails";
$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $dbh);
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'COUNT *');


$sql = "select * from orderdetails where orderNumber = 10101";
$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $dbh);
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'By orderNumber');

$sql = "SELECT 
    c.customerNumber, c.customerName, orderNumber, o.status
FROM
    customers c
        LEFT JOIN
    orders o ON c.customerNumber = o.customerNumber;";

$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $dbh);
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'LEFt JOIN ');


$sql = "UPDATE employees 
SET 
    lastname = 'Hill',
    email = 'mary.hill@classicmodelcars.com'
WHERE
    employeeNumber = 1056;";
$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $dbh);
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'UPDATE ');


$sql = "SELECT 
    employeeNumber, lastName, firstName
FROM
    employees
WHERE
    firstname LIKE 'T_m';";

$memory = memory_get_usage($real);
$benchmark->start($memory);
$sth = $dbh->prepare($sql);
$sth->execute(array($res));
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'LIKE ');


$sth = $dbh->prepare($sql);
$sth->execute();
$res = $sth->fetch(PDO::FETCH_NUM);
$maxOfficeCode = $res[0];



$OfficeCode = $maxOfficeCode + 1;
$sql = "INSERT INTO offices(officeCode, city, phone, addressLine1, country, postalCode, territory)
VALUES('$OfficeCode', 'Paris', '0123456789', 'address ligne 1', 'FRANCE', '75012', 'FR');";
$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $dbh);
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'INSERT ');


$sql = "DELETE  
    offices 
FROM  
 offices 
WHERE  offices.officeCode = ?";
$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $dbh, true);
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'DELETE ');



$totalMemoryEnd = memory_get_usage($real);
echo $totalMemoryEnd - $totalMemory;
