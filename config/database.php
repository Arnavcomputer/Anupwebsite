<?php
// HOSTINGER LIVE DATABASE DETAILS
// Replace these with the ones you create in Hostinger -> Databases
$host = "localhost"; 
$db   = "YOUR_HOSTINGER_DB_NAME";
$user = "YOUR_HOSTINGER_DB_USER";
$pass = "YOUR_HOSTINGER_DB_PASSWORD";

// Local Docker Database details (Automatically used when you test on localhost)
if (isset($_SERVER['HTTP_HOST']) && (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false)) {
    $host = "db";
    $db   = "gyandayini_academy";
    $user = "root";
    $pass = "";
}

$charset = "utf8mb4";
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed. Please create/import the database first. Error: " . htmlspecialchars($e->getMessage()));
}
?>
