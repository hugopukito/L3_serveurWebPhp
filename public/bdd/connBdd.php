<?php

// Connexion à la Base de données

$host = 'localhost';
$bdd ='blogbdd_pukito';
$user = 'root';
$psw = 'toor';
$port = '3306';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$bdd;port=$port;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $psw, $options);
} 

catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), $e->getCode());
}

?>