<?php

include '../BenchmarkTimer.php';
$totalMemory = memory_get_usage($real);
$benchmark = new BenchmarkTimer(false);
$real = false;

// on se connect à localhost au port 3307
$link = mysql_connect('127.0.0.1', 'root', 'root');
if (!$link) {
    die('Connexion impossible : ' . mysql_error());
}

if (!mysql_select_db('classicmodels', $link)) {
    echo 'Sélection de base de données impossible';
    exit;
}

//$sqlMax = "SELECT max(officeCode) FROM offices";
//$result = mysql_query($sqlMax, $link);
//
//$array = mysql_fetch_array($result);
//$maxOfficeCode = $array[0];
//var_dump($maxOfficeCode);
//exit;
function geResult($sql, $link, $action = false)
{
    if ('insert' == $action) {
        for ($i = 100; $i <= 1100; $i++) {
            $sql = "INSERT INTO offices(officeCode, city, phone, addressLine1, country, postalCode, territory)
VALUES($i, 'Paris', '0123456789', 'address ligne 1', 'FRANCE', '75012', 'FR');";
            $result = mysql_query($sql);
//            if (!$result) {
//                echo "Erreur DB, impossible d'effectuer une requête\n";
//                echo 'Erreur MySQL : ' . mysql_error();
//                echo $sql . "\n";
//                exit;
//            }
        }
    } else if ('delete' == $action) {
        for ($i = 100; $i <= 1100; $i++) {
            $sql = "DELETE  FROM   offices WHERE  offices.officeCode = $i";
            $result = mysql_query($sql, $link);
//            if (!$result) {
//                echo "Erreur DB, impossible d'effectuer une requête\n";
//                echo $sql . "\n";
//                echo 'Erreur MySQL : ' . mysql_error();
//                exit;
//            }
        }
    }
    for ($i = 100; $i <= 1100; $i++) {
        $result = mysql_query($sql, $link);
//        if (!$result) {
//            echo "Erreur DB, impossible d'effectuer une requête\n";
//            echo 'Erreur MySQL : ' . mysql_error();
//            echo $sql . "\n";
//
//            echo $i;
//
//            exit;
//        }
    }
    return true;
}

$sql = "select * from orderdetails";
$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $link);
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'SELECT *');

$sql = "select count(*) from orderdetails";
$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $link);
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'COUNT *');


$sql = "select * from orderdetails where orderNumber = 10101";
$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $link);
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
$result = geResult($sql, $link);
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
$result = geResult($sql, $link);
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
$result = geResult($sql, $link);
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'LIKE ');


//$sqlMax = "SELECT max(officeCode) FROM offices";
//$result = mysql_result($sqlMax, $link);
//$array = mysql_fetch_array($result);
//$maxOfficeCode = $array[0];
//
//
//
//$OfficeCode = $maxOfficeCode + 1;
$sql = "INSERT INTO offices(officeCode, city, phone, addressLine1, country, postalCode, territory)
VALUES('$OfficeCode', 'Paris', '0123456789', 'address ligne 1', 'FRANCE', '75012', 'FR');";
$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $link, 'insert');
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'INSERT ');


$sql = "DELETE  
    offices 
FROM  
 offices 
WHERE  offices.officeCode = ";
$memory = memory_get_usage($real);
$benchmark->start($memory);
$result = geResult($sql, $link, 'delete');
$pick = memory_get_peak_usage($real);

$benchmark->stop($pick, 'DELETE ');

$totalMemoryEnd = memory_get_usage($real);
echo $totalMemoryEnd - $totalMemory;
